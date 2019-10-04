<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// product image model
use App\ProductImage;
use Auth;

class Product_ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //use the default guard (web)
    }
    public function store(Request $request)
    {
        // foreach($request->file('filename') as $image)
        //     {
        //         $name=$image->getClientOriginalName();
        //         $image->move(public_path().'/public/uploads/products/', $name);  
        //         $data[] = $name;  
        //     }
        return $request;

  //      return $request;
        // $this->validate($request, [

        //         'filename' => 'required',
        //         'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        // ]);
        
        // if($request->hasfile('filename'))
        //  {

        //     foreach($request->file('filename') as $image)
        //     {
        //         $name=$image->getClientOriginalName();
        //         $image->move(public_path().'/public/uploads/products/', $name);  
        //         $data[] = $name;  
        //     }
        //  }

        // $Product_image= new ProductImage();

   
        // $Product_image->product_id = $request->input('id');
        // $Product_image->filename=json_encode($data);
        // $Product_image->save();

        // return back()->with('success', 'Your images has been successfully');
    }





}
