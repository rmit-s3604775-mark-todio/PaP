<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// database
use DB;
use DateTime;
// model
use App\product;
use Auth;
use App\ProductImage;
use Image;
use File;



class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web,admin'); //use the default guard (web)
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
			"quantity"=>'required, min:1',
			"brand"=>'required',
      "quantity"=>'required',
      "description"=>'required'
    ]);

    $images_array = array();
    
    $user = Auth::user();
    $product->user_id = $user->id;
    
    if($request->has('images'))
    {
        foreach($request->images as $image)
        {       
            $filename =  time() . "-". $image->getClientOriginalName();
            $images_array[] = $filename;
            Image::make($image)->resize(null, 300, function($constraint){
              $constraint->aspectRatio();
            })->save( public_path('/uploads/products/'. $filename) );
        }
        $product->images = json_encode($images_array);
    }
    else
    {
        $images_array[] = "defaultPhone.png";
        $product->images = json_encode($images_array);
    }
		
		
	
    // $product->user_id = $user->id;
    
    
		$product->brand = $request->brand;
    $product->condition = $request->condition;
		$product->product_name = $request->product_name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->created_at = new DateTime();
    $product->updated_at = new DateTime();
    $product->description = $request->description;
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
     //   return $item;


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
       $product = product::find($id);

      // get the values taht are to be deleted
      $updatedValues = array();
      if($request->has('imagesDelete'))
      {
        $productimages = $product->images;
        $requestimages = $request->imagesDelete;

        // turn values into arrays for comparison
        $databaseValArray = json_decode($productimages, true);
        $imagesDelArray = explode(",", $requestimages);
      
        // compare arrays then delete duplicates
        $updatedValues = array_merge(array_diff($databaseValArray, $imagesDelArray));

        // delete images from folder
        foreach($imagesDelArray as $imageDel)
        {  
          if(File::exists(public_path('/uploads/products/'. $imageDel))) {
            File::delete(public_path('/uploads/products/'. $imageDel));
          }
        }
      }else{
        // keep old valyes
        $updatedValues = $databaseValArray;
      }

      $images_array = array();
      if($request->has('images'))
      {
          foreach($request->images as $image)
          {      
              $filename = time() . "-". $image->getClientOriginalName();
              $images_array[] = $filename;
              Image::make($image)->resize(null, 300, function($constraint){
                $constraint->aspectRatio();
              })->save( public_path('/uploads/products/'. $filename) );
          }
          
          $combineArray = array_merge($updatedValues, $images_array);
          $product->images = json_encode($combineArray);
      }else{
        if(empty($updatedValues)){
          $updatedValues[] = "defaultPhone.png";
          $product->images = json_encode($updatedValues);
        }else{
          $product->images = json_encode($updatedValues);
        }
      }

		$this->validate($request,[
			"product_name"=>'required',
			"price"=>'required',
			"quantity"=> ['required', 'numeric', 'min:0'],
			"brand"=>'required',
      "condition"=>'required',
      "description" => 'required'
    ]);
      
    // need to remove rating
    $product->rating = 5;

		$product->product_name = $request->product_name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->brand = $request->brand;
    $product->condition = $request->condition;
    $product->description = $request->description;
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
