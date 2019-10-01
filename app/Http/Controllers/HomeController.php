<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    /**
     * Show the user settings
     * 
     * @return view user.settings
     */
    public function settings()
    {
        return view('user.settings');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'avatar' => ['mimes:jpg,jpeg,png,gif', 'max:5000', 'nullable'],
            'name' => ['string', 'max:255', 'nullable'],
            'username' => ['string', 'max:128', 'unique:users', 'nullable'],
            'address_line_1' => ['max:128', 'nullable'],
            'address_line_2' => ['max:128', 'nullable'],
            'state_province' => ['string', 'max:128', 'nullable'],
            'post_code' => ['numeric', 'nullable'],
            'country' => ['string', 'max:128', 'nullable'],
            'city' => ['string', 'max:128', 'nullable'],
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

        if ($request->has('username') & $request->username != null) {
            $user = Auth::user();
            $user->username = $request->username;
            $user->save();
        }

        if ($request->has('address_line_1') & $request->address_line_1 != null) {
            $user = Auth::user();
            $user->address_line_1 = $request->address_line_1;
            $user->save();
        }

        /**
         * Checked, Blank
         * - Ignore
         * 
         * Checked, Filled
         * 
         * Unckecked, Blank
         * 
         * Unckecked, Filled
         * 
         */
        if ($request->has('blank')) {
            $user = Auth::user();
            $user->address_line_2 = null;
            $user->save();
        } else {
            if ($request->has('address_line_2') & $request->address_line_2 != null) {
                $user = Auth::user();
                $user->address_line_2 = $request->address_line_2;
                $user->save();
            }
        }

        if ($request->has('state_province') & $request->state_province != null) {
            $user = Auth::user();
            $user->state_province = $request->state_province;
            $user->save();
        }

        if ($request->has('post_code') & $request->post_code != null) {
            $user = Auth::user();
            $user->post_code = $request->post_code;
            $user->save();
        }

        if ($request->has('country') & $request->country != null) {
            $user = Auth::user();
            $user->country = $request->country;
            $user->save();
        }

        if ($request->has('city') & $request->city != null) {
            $user = Auth::user();
            $user->city = $request->city;
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

        return redirect()->route('settings')->withStatus('Updated Successfully');
    }
}
