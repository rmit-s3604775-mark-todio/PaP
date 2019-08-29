<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin'); //use the admin guard
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function administrators()
    {
        return view('admin.administrators');
    }

    public function products()
    {
        return view('admin.products');
    }

    public function messages()
    {
        return view('admin.messages');
    }

    public function update_avatar(Request $request)
    {

        $this->validate($request, [
            'avatar-file' => ['required', 'mimes:jpg,jpeg,png,gif', 'max:5000'],
        ]);

        $avatar = $request->file('avatar-file');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();

        Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/'. $filename) );
        
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();

        return view('admin.settings');
    }
}
