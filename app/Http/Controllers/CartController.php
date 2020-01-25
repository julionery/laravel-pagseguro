<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::find($id);
        if(!$product)
            return redirect()->back();

        $cart = new Cart;
        $cart->add($product);

        Session::put('cart', $cart);
        return redirect()->route('cart');
    }

    public function remove($id)
    {
        $product = Product::find($id);
        if (!$product)
            return redirect()->back();

        $cart = new Cart;
        $cart->remove($product);

        Session::put('cart', $cart);
        return redirect()->route('cart');
    }
}
