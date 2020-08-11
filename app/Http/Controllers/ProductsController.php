<?php

namespace App\Http\Controllers;

use App\Product;
use App\Property;
use Illuminate\Http\Request;
use App\Picture;

class ProductsController extends Controller
{
    public function index()
    {
        $properties = Property::all();

        return view('landing', compact('properties'));
    }
    public function rentals()
    {
        $properties = Property::where('type', 2)->get();

        return view('rentals', compact('properties'));
    }
   
    public function buys()
    {
        $properties = Property::where('type', 1)->get();

        return view('buys', compact('properties'));
    }
    public function contact()
    {
        $property = Property::all();

        return view('contact', compact('property'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($id)
    {
        $property = Property::find($id);
        $picture=Picture::where('property_id',$id)->first();

     
        if(!$property) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first property
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $property->name,
                        "quantity" => 1,
                        "price" => $property->price,
                        "picture" => $picture
                    ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Property added to cart successfully!');
        }

        // if cart not empty then check if this property exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Property added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $property->name,
            "quantity" => 1,
            "price" => $property->price,
            "picture" => $picture
        ];
     
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Property added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Property removed successfully');
        }
    }
    
}
