<?php

namespace App\Http\Controllers;

use App\ProductRequest;
use App\product;
use Illuminate\Http\Request;
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
        $requests = ProductRequest::where('user_id', $user->id)->get();

        return view('user.request.products', compact('requests'));
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
        $productRequest = new ProductRequest;
        $this->validate($request, [ //This is for validating, basically like ensuring you put the right type or value.
            "product_name" => ['required'],
            "brand" => ['nullable', 'exists:brands,brand'],
            "condition" => ['nullable', 'exists:conditions,condition'],
            "max_price" => ['nullable', 'numeric', 'lte:999999', 'gte:min_price'],
            "min_price" => ['nullable', 'numeric', 'lte:max_price', 'gte:0']
        ]);

        $user = Auth::user();

        $productRequest->product_name = $request->product_name;
        $productRequest->user_id = $user->id;
        $productRequest->brand = $request->brand;
        $productRequest->condition = $request->condition;
        $productRequest->max_price = $request->max_price;
        $productRequest->min_price = $request->min_price;
        
        $productRequest->save();
		return redirect()->route('product-search.index');
		
        //return view('user.request.products'); (no need)
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRequest $productRequest)
    {
        $req = DB::table('requests')->where($productRequest)->get();
        return $req;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
	 
	 
    public function edit($id)
    {//I am going to put edit in this. This will be used to edit the existing data. 
	//Basically you can change the product name, brands, condition, minimal price, and maximum price.
        $item = ProductRequest::find($id);
        return view('user.request.edit', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()], compact('item'));
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
        $this->validate($request,[
            "product_name"=> ['required'],
            "brand" => ['nullable', 'exists:brands,brand'],
            "condition" => ['nullable', 'exists:conditions,condition'],
			"max_price" => ['nullable', 'numeric', 'lte:999999', 'gte:min_price'],
            "min_price" => ['nullable', 'numeric', 'lte:max_price', 'gte:0']
		]);
	
		$requests = ProductRequest::find($id);
		
		$requests->product_name = $request->product_name;
		$requests->brand = $request->brand;
		$requests->condition = $request->condition;
		$requests->min_price = $request->min_price;
		$requests->max_price = $request->max_price;
		$requests->updated_at = new DateTime();
		
		$requests->save();
		
		return redirect()->route('product-search.index');
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
		
		/**return redirect('products');*/
		
		return redirect()->route('product-search.index');
    }

    /**
     * Matching of products to product search (aka product request)
     * 
     * @param ProductRequest $ps
     * @return Eloquent $results
     */
    public function match(ProductRequest $ps)
    {
        $productConstraint = new product;
        $productConstraint = $productConstraint->where('user_id', '!=', Auth::user()->id);

        if($ps->max_price != null) {
            $productConstraint = $productConstraint->where('price', '<=', 150);
        }

        if($ps->min_price != null) {
            $productConstraint = $productConstraint->where('price', '>=', $ps->min_price);
        }

        if($ps->brand != null) {
            $productConstraint = $productConstraint->where('brand', $ps->brand);
        }

        if($ps->condition != null) {
            $productConstraint = $productConstraint->where('condition', $ps->condition);
        }

        $results = product::search($ps->product_name)->constrain($productConstraint);
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
