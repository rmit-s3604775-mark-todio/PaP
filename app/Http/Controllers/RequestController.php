<?php

namespace App\Http\Controllers;

use DB;
use App\ProductRequest;
use Illuminate\Http\Request;
use Auth;
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
    {
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
        $this->validate($request, [
            "product_name" => 'required',
            "max_price" => 'number',
            "min_price" => 'number'
        ]);

        $user = Auth::user();

        $productRequest->product_name = $request->product_name;
        $productRequest->user_id = $user->id;
        $productRequest->brand = DB::table('brands')->find($request->brand);
        $productRequest->condition = $request->condition;
        $productRequest->max_price = $request->max_price;
        $productRequest->min_price = $request->min_price;
        $productRequest->created_at = new DateTime();
        $productRequest->updated_at = new DateTime();
        
        $productRequest->save();
        return view('user.request.products');
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
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRequest $productRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRequest $productRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRequest $productRequest)
    {
        //
    }
}
