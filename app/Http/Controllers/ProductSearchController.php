<?php

namespace App\Http\Controllers;

use App\ProductRequest;
use App\product;
use Illuminate\Http\Request;
use App\Rules\gtenn;
use App\Rules\ltenn;
use Auth;
use DB;

class ProductSearchController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //use the default guard (web)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $requests = ProductRequest::where('user_id', $user->id)->paginate(15);

        return view('user.request.phones', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {//This function is for calling create.blade file. Because brand and condition is dropdown menu, it needs to be able to show
	//the content in this database, that's why both of this table is called.
        return view('user.request.create', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phoneRequest = new ProductRequest;
        $this->validate($request, [ //This is for validating, basically like ensuring you put the right type or value.
            "product_name" => ['required'],
            "brand" => ['nullable', 'exists:brands,brand'],
            "condition" => ['nullable', 'exists:conditions,condition'],
            "max_price" => ['nullable', 'numeric', 'max:999999', new gtenn("Min Price", $request->min_price)],
            "min_price" => ['nullable', 'numeric', 'min:0', new ltenn("Max Price", $request->max_price)]
        ]);

        $user = Auth::user();

        $phoneRequest->product_name = $request->product_name;
        $phoneRequest->user_id = $user->id;
        $phoneRequest->brand = $request->brand;
        $phoneRequest->condition = $request->condition;
        $phoneRequest->max_price = $request->max_price;
        $phoneRequest->min_price = $request->min_price;
        
        $phoneRequest->save();
		return redirect()->route('phone-search.index');
		
        //return view('user.request.phones'); (no need)
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ProductRequest  $phoneRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRequest $phoneRequest)
    {
        $req = DB::table('requests')->where($phoneRequest)->get();
        return $req;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
	 
	 
    public function edit($id)
    {
        $req = ProductRequest::find($id);
        $brands = DB::table('brands')->get();
        $conditions = DB::table('conditions')->get();

        return view('user.request.edit')
                    ->with(compact('brands'))
                    ->with(compact('conditions'))
                    ->with(compact('req'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductRequest  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            "product_name"=> ['required'],
            "brand" => ['nullable'],
            "condition" => ['nullable'],
            "max_price" => ['nullable', 'numeric', 'max:999999', new gtenn("Min Price", $request->min_price)],
            "min_price" => ['nullable', 'numeric', 'min:0', new ltenn("Max Price", $request->max_price)]
        ]);
	
		$req = ProductRequest::find($id);
		
        $req->product_name = $request->product_name;
        
        if($request->brand != "None") {
            $brand = DB::table('brands')->where('brand', $request->brand)->first();
            $req->brand = $brand->brand;
        } else {
            $req->brand = null;
        }

        if ($request->condition != "None") {
            $condition = DB::table('conditions')->where('condition', $request->condition)->first();
            $req->condition = $condition->condition;
        } else {
            $req->condition = null;
        }
        
		$req->min_price = $request->min_price;
		$req->max_price = $request->max_price;
		
		$req->save();
		
		return redirect()->route('phone-search.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //This is also my part (Ega). This will remove a data in Product request. This will also be removed from database
		DB::table('requests')->where('id', $id)->delete();
		
		/**return redirect('phones');*/
		
		return redirect()->route('phone-search.index');
    }

    /**
     * Matching of phones to phone search (aka phone request)
     * 
     * @param ProductRequest $ps
     * @return Eloquent $results
     */
    public function match(ProductRequest $ps)
    {
        $phoneConstraint = new product;
        $phoneConstraint = $phoneConstraint->where('user_id', '!=', Auth::user()->id);

        if($ps->max_price != null) {
            $phoneConstraint = $phoneConstraint->where('price', '<=', $ps->max_price);
        }

        if($ps->min_price != null) {
            $phoneConstraint = $phoneConstraint->where('price', '>=', $ps->min_price);
        }

        if($ps->brand != null) {
            $phoneConstraint = $phoneConstraint->where('brand', $ps->brand);
        }

        if($ps->condition != null) {
            $phoneConstraint = $phoneConstraint->where('condition', $ps->condition);
        }

        $results = product::search($ps->product_name)->constrain($phoneConstraint);
        return $results;
    }

    /**
     * Returns the result of the match
     * 
     * @param $id
     * @return View user.request.results
     */
    public function results($id)
    {
        $ps = ProductRequest::find($id);
        
        if($ps->user_id != Auth::user()->id) {
            return redirect()->back()->withError('Invalid Request');
        } else {
            $results = $this->match($ps)->orderBy('created_at', 'asc')->paginate(15);
            return view('user.request.results')
                        ->with(compact('results'))
                        ->with(compact('ps'))
                        ->withStatus('Success');
        }
    }
}
