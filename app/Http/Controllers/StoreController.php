<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PagSeguro;
use App\Models\Product;
use Session;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Product $product)
    {
        $products = $product->all();
        return view('store.home.index', compact('products'));
    }

    public function cart()
    {
        $title = 'Meu Carrinho de Compras!';
        $cart = new Cart;

        $products = $cart->getItems();
        //dd($pagSeguro->paymentBillet('dasdas'));
        //dd($cart->getTotalItems());
        //dd($cart->getTotal());
        return view('store.cart.cart', compact('title', 'cart', 'products'));
    }

    public function methodPayment()
    {
        $title = 'Escolha o método de pagamento';

        return view('store.payment.method-payment', compact('title'));
    }
}
