<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// database
use DB;
use DateTime;
// model
use App\product;
use Auth;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$products = product::where('user_id', $user->id)->get();
        return view('user.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create an item here and view it on view page
		return view('user.products.create', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$product = new product;
		$this->validate($request,[
			"product_name"=>'required',
			"price"=>'required',
			"quantity"=>'required',
			"brand"=>'required',
			"quantity"=>'required'
		]);
		
		$user = Auth::user();
		
		$product->user_id = $user->id;
	//	$product->brand = DB::table('brands')->find($request->brand);
    //    $product->condition = DB::table('conditions')->find($request->condition);
	
		$product->brand = $request->brand;
        $product->condition = $request->condition;
	
		$product->product_name = $request->product_name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->created_at = new DateTime();
		$product->updated_at = new DateTime();
		$product->rating = 5;
		$product->save();
		return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = DB::table('products')->get();
		return "show function";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// show edit page
		$item = product::find($id);
        return view('user.products.edit', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()], compact('item'));
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$this->validate($request,[
			"product_name"=>'required',
			"price"=>'required',
			"quantity"=>'required',
			"rating"=>'required',
		//	"brand"=>'required',
		//	"condition"=>'required'
			
		]);
	
		$product = product::find($id);
		
		$product->product_name = $request->product_name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->rating = $request->rating;
		$product->brand = $request->brand;
		$product->condition = $request->condition;
		$product->updated_at = new DateTime();
		$product->save();
		
		return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		DB::table('products')->where('id', '=', $id)->delete();
		
		return redirect('products');
    }
	
	public function details($id)
	{
		$item = product::find($id);
		return view('user.products.details', compact('item'));
	}
}
