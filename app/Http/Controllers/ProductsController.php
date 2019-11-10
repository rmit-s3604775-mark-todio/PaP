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
        $this->middleware('auth:web')->except([
            'show',
            'destroy',
        ]);
        $this->middleware('auth:web,admin')->only(['destroy', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$phones = product::where('user_id', $user->id)->paginate(10);
        return view('user.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create an item here and view it on view page
		return view('user.phones.create', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$phone = new product;
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
        $phone->user_id = $user->id;
    
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
            $phone->images = json_encode($images_array);
        }
        else
        {
            $images_array[] = "defaultPhone.png";
            $phone->images = json_encode($images_array);
        }
		
		
	
        // $phone->user_id = $user->id;
    
    
		$phone->brand = $request->brand;
        $phone->condition = $request->condition;
		$phone->product_name = $request->product_name;
		$phone->price = $request->price;
		$phone->quantity = $request->quantity;
		$phone->created_at = new DateTime();
        $phone->updated_at = new DateTime();
        $phone->description = $request->description;
		$phone->rating = 5;
        $phone->save();

		 return redirect('phones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = product::find($id);
        return view('user.phones.details', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = product::find($id);
        return view('user.phones.edit', [ 'brands' => DB::table('brands')->get(), 'conditions' => DB::table('conditions')->get()], compact('item'));
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
			"quantity"=> ['required', 'numeric', 'min:0'],
			"brand"=>'required',
            "condition"=>'required',
            "description" => 'required'
        ]);
        
        $phone = product::find($id);

        // get the values taht are to be deleted
        $updatedValues = array();
        if($request->has('imagesDelete'))
        {
            $phoneimages = $phone->images;
            $requestimages = $request->imagesDelete;

            // turn values into arrays for comparison
            $databaseValArray = json_decode($phoneimages, true);
            $imagesDelArray = explode(",", $requestimages);
      
            // compare arrays then delete duplicates
            $updatedValues = array_merge(array_diff($databaseValArray, $imagesDelArray));

            // delete images from folder
            foreach($imagesDelArray as $imageDel)
            {  
                if(File::exists(public_path('/uploads/products/'. $imageDel)) && $imageDel != 'defaultPhone.png') {
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
            $phone->images = json_encode($combineArray);
        }else{
            if(empty($updatedValues)){
                $updatedValues[] = "defaultPhone.png";
                $phone->images = json_encode($updatedValues);
            }else{
                $phone->images = json_encode($updatedValues);
            }
        }
      
        // need to remove rating
        $phone->rating = 5;
		$phone->product_name = $request->product_name;
		$phone->price = $request->price;
		$phone->quantity = $request->quantity;
		$phone->brand = $request->brand;
        $phone->condition = $request->condition;
        $phone->description = $request->description;
		$phone->updated_at = new DateTime();
        $phone->save();
    
        return redirect('phones');
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

        if(Auth::guard('web')->check()) {
            return redirect()->route('phones.index');
        }elseif(Auth::guard('admin')->check()) {
            return redirect()->route('admin.phone');
        }
    }
    
    /**
     * Search for phones and return the phones view.
     */
    public function searchProduct(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $phones = Product::search($request->search)->where('user_id', Auth::user()->id)->paginate(15);
        return view('user.phones.index', compact('phones'));
    }
}
