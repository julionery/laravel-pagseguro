<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PagSeguro;
use Illuminate\Http\Request;

class PagSeguroController extends Controller
{
    public function pagseguro(PagSeguro $pagSeguro)
    {
        $code = $pagSeguro->generate();
        $urllRedirect = config('pagseguro.url_redirect_after_request').$code;

        return redirect()->away($urllRedirect); // ->away = redireciona para uma rota externa;
    }

    public function lightbox()
    {
        return view('pagseguro-lightbox');
    }

    public function transparente()
    {
        return view('pagseguro-transparente');
    }

    public function lightboxCode(PagSeguro $pagSeguro)
    {
        return $pagSeguro->generate();
    }

    public function transparenteCode(PagSeguro $pagSeguro)
    {
        return $pagSeguro->getSessionId();
    }

    public function billet(Request $request, PagSeguro $pagSeguro, Order $order)
    {
        $response = $pagSeguro->paymentBillet($request->sendHash);

        $cart = new Cart;
        $order->newOrderProducts($cart, $response['reference'], $response['code']);
        $cart->emptyCart();
        return response()->json($response, 200);
    }

    public function card()
    {
        return view('pagseguro-transparent-card');
    }

    public function cardTransaction(Request $request, PagSeguro $pagSeguro)
    {
        return $pagSeguro->paymentCredCard($request);
    }
}
