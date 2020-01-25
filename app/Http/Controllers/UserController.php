<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    public function profile()
    {
        $title = 'Meu Perfil';
        return view('store.user.profile', compact('title'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function password()
    {
        $title = 'Minha Senha';
        return view('store.user.password', compact('title'));
    }

    public function passwordUp(Request $request)
    {
        $update = auth()->user()->updatePassoron($request['password']);

          if ($update)
              return redirect()->route('profile')->with('message', 'Perfil Atualizado com Sucesso!');

        return redirect()->back()->with('error', 'Falha ao Atualizar!');
    }

    public function passwordUpdate(Request $request)
    {
        $update = auth()->user()->updatePassword($request['password']);

          if ($update)
              return redirect()->route('profile')->with('message', 'Perfil Atualizado com Sucesso!');

        return redirect()->back()->with('error', 'Falha ao Atualizar!');
    }

    public function profileUpdate(Request $request, User $user)
    {
        $this->validate($request, $user->rulesUpdateProfile());

        $dataForm = $request->all();

        if (isset($dataForm['email']))
            unset($dataForm['email']);

        if (isset($dataForm['cpf']))
            unset($dataForm['cpf']);

        $update = auth()->user()->profileUpdate($dataForm);

        if ($update)
            return redirect()->route('profile')->with('message', 'Perfil Atualizado com Sucesso!');

        return redirect()->back()->with('error', 'Falha ao Atualizar!');
    }

    public function myOrders(Order $order)
    {
        $title = "Meus Pedidos";

        $orders = $order->user()->get();  //scope do usuário logado
        //$orders = auth()->user()->orders();
        //dd($orders);
        return view('store.orders.orders', compact('title', 'orders'));
    }

    public function detailsOrder(Order $order, $reference)
    {
        $order = $order->user()->where('reference', $reference)->get()->first();

        if(!$order)
            return redirect()->back()->with('error', 'Pedido não Encontrado!');

        $title = "Detalhes do pedido {$order->id}";

        $products = $order->products()->get();

        return view('store.orders.products', compact('title', 'order', 'products'));
    }
}
