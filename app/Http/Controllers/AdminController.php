<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use App\product;
use App\User;
use App\Admin;

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

    /**
     * Users Page
     * 
     * Returns the users view with all the users paginated.
     * 
     * @return view admin.users
     */
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * user Search
     * 
     * returns the admin.user view with the search results
     * 
     * @param Request $request
     * @return view admin.user
     */
    public function userSearch(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $users = User::search($request->search)->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Administrators
     * 
     * Returns the administrators view
     * 
     * @return view admin.administrators
     */
    public function administrators()
    {
        $admins = Admin::where('id', '!=', Auth::user()->id)->paginate(5);
        return view('admin.administrators', compact('admins'));
    }

    /**
     * Administrator Search
     * 
     * Returns the administrators view with the search results
     * 
     * @param Request $request
     * @return view admin.administrators
     * 
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $admins = Admin::search($request->search)->paginate(5);
        return view('admin.administrators', compact('admins'));
    }

    /**
     * Products
     * 
     * Returns the products view with all the products paginated.
     * 
     * @return view admin.products
     */
    public function products()
    {
        $products = product::paginate(15);
        return view('admin.products', compact('products'));
    }

    /**
     * Destroy Product
     * 
     * @param int $id id of the product to delete
     * @return view admin.products
     */
    public function productDestroy($id)
    {
        product::where('id', '=', $id)->delete();
        return $this->products();
    }

    /**
     * Product Search
     * 
     * Return the admin products page with the search results.
     * 
     * @param Request $request
     * @return view admin.products
     */
    public function productSearch(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $products = Product::search($request->search)->paginate(15);
        return view('admin.products', compact('products'));
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
