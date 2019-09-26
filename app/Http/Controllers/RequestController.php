<?php

namespace App\Http\Controllers;

use App\ProductRequest;
use Illuminate\Http\Request;
use Auth;
use DateTime;//Either this one disappear or I delete it in the past. But either way, I put this back in. (Ega)
use DB;

class RequestController extends Controller
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
        $this->validate($request, [//This is for validating, basically like ensuring you put the right type or value.
            "product_name" => 'required',
            "max_price" => 'numeric',//This one is previously 'number'. But 'number' is apparently the wrong variable.
            "min_price" => 'numeric' //numeric is the correct variable
        ]);

        $user = Auth::user();

        $productRequest->product_name = $request->product_name;
        $productRequest->user_id = $user->id;
        $productRequest->brand = $request->brand;
        $productRequest->condition = $request->condition; //DB::table('conditions')->find($request->condition); (old code)
        $productRequest->max_price = $request->max_price;
        $productRequest->min_price = $request->min_price;
        $productRequest->created_at = new DateTime();
        $productRequest->updated_at = new DateTime();
        
        $productRequest->save();
		return redirect('product-request');
		
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
			"product_name"=>'required',
			"max_price" => 'numeric',//This one is previously 'number'. But 'number' is apparently the wrong variable.
            "min_price" => 'numeric' //numeric is the correct variable
		]);
	
		$requests = ProductRequest::find($id);
		
		$requests->product_name = $request->product_name;
		$requests->brand = $request->brand;
		$requests->condition = $request->condition;
		$requests->min_price = $request->min_price;
		$requests->max_price = $request->max_price;
		$requests->updated_at = new DateTime();
		
		$requests->save();
		
		return redirect('product-request');
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
		
		return redirect('product-request');
    }
}
