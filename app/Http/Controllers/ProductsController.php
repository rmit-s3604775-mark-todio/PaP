<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// database
use DB;
use DateTime;
// model
use App\product;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$products = product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create an item here and view it on view page
	/*	DB::table('products')->insert(
			['product_name'=>'Lenovo laptop', 'price'=>2000.10, 'quantity'=>1, 'quantity_remaining'=>'1', 'rating'=>5,'created_at'=>new DateTime(), 'updated_at'=>new DateTime()]
			);
		
		$prod = DB::table('products')->get();
		return $prod;
	*/
		return view('products.create');
	//	return "hello world";
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
			"quantity"=>'required'
		]);
		
		
		$product->product_name = $request->product_name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->quantity_remaining = $request->quantity;
		$product->created_at = new DateTime();
		$product->updated_at = new DateTime();
		$product->rating = 5;
		$product->save();
		return redirect('products');
    //   return $request->all();
	//	return "hello";
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
		return $prod;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
