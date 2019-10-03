<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Admin;
use Image;
use DB;

trait RegisterAdmins
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    /**
     * 
     * Register a new administrator
     * 
     * @param Request $request
     * @return Redirect route admin.administrators
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/'. $filename) );
            
            $data = $request->all();
            $data['filename'] = $filename;

            event(new Registered($admin = $this->create($data)));

        } else {
            event(new Registered($admin = $this->create($request->all())));
        }

        $admins = Admin::where('id', '!=', Auth::user()->id)->paginate(5);
        return $this->registered($request, $admin)
                        ?: redirect()->route('admin.administrators', compact('admins'))->withStatus('Added Administrator');
    }

    /**
     * Delete administrator account
     * 
     * @return Redirect::back
     */
    public function destroy($id)
    {
        DB::table('admins')->where('id', '=', $id)->delete();
        $admins = Admin::where('id', '!=', Auth::user()->id)->paginate(5);
        return back()->withStatus('Deleted')->with(compact('admins'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The admin has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $admin
     * @return mixed
     */
    protected function registered(Request $request, $admin)
    {
        //
    }
}