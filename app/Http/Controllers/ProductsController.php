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
		$products = product::where('user_id', $user->id)->paginate(10);
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
		DB::table('products')->where('id', '=', $id)->delete();
		
		return redirect('products');
    }

    /**
     * Search for products and return the products view.
     */
    public function searchProduct(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $products = Product::search($request->search)->paginate(15);
        return view('user.products.index', compact('products'));
    }
}
