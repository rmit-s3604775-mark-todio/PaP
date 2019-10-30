<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\product;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $phones = product::orderBy('created_at', 'desc')->take(10)->get();
        return view('welcome', compact('phones'));
    }

    /**
     * Search for products and return the products view.
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $phones = Product::search($request->search)->orderBy('price')->paginate(15);
        return view('guestSearch', compact('phones'));
    }
}
