<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use App\product;
use App\ProductRequest;
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

    /**
     * Returns the settings view
     * 
     * @return view admin.settings
     */
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
     * Deletes the user account
     * 
     * @param int $id id of the account to be deleted
     * @return Redirect::back
     */
    public function userDestroy($id)
    {
        //Need to manually delete all the products and ProductRequests
        //As the users have no foreign keys to the products and users
        product::where('user_id', $id)->delete();
        ProductRequest::where('user_id', $id)->delete();
        User::where('id', '=', $id)->delete();

        $users = User::paginate(15);
        return back()->withStatus('Deleted')->with(compact('users'));
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
        return view('admin.administrators')->with(compact('admins'));
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
        $products = product::paginate(15);
        return back()->withStatus('Deleted')->with(compact('products'));
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

    /**
     * Administrator Messages view
     * 
     * @return view admin.messages
     */
    public function messages()
    {
        return view('admin.messages');
    }

    /**
     * Update Administrators Profile details
     * 
     * @param Request $request
     * @return Redirect::route admin.setings
     */
    public function update(Request $request)
    {

        $this->validate($request, [
            'avatar' => ['mimes:jpg,jpeg,png,gif', 'max:5000', 'nullable'],
            'name' => ['string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', 'unique:admins', 'nullable'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
        ]);
        
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/'. $filename) );
            
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        if ($request->has('name') & $request->name != null) {
            $user = Auth::user();
            $user->name = $request->name;
            $user->save();
        }

        if ($request->has('email') & $request->email != null) {
            $user = Auth::user();
            $user->email = $request->email;
            $user->save();
        }

        if ($request->has('password') & $request->password != null) {
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('admin.settings')->withStatus('Updated Successfully');
    }
}
