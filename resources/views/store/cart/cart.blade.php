@extends('store.layouts.main')

@section('content')
    <h1 class="title">
        Meu Carrinho
    </h1>
    <table class="table table-striped">
        <tr>
            <th>Item</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Sub. Total</th>
        </tr>
        @forelse($products as $product)
            <tr>
                <td>
                    <img src="{{url("assets/imgs/temp/{$product['item']->image}")}}" alt="" class="img-cart">
                    {{$product['item']->name}}
                </td>
                <td>R$ {{$product['item']->price}}</td>
                <td>
                    {{$product['qtd']}}
                    <a href="{{route('add.cart', $product['item']->id)}}" class="cart-action-item">+</a> -
                    <a href="{{route('remove.cart', $product['item']->id)}}" class="cart-action-item">-</a>
                </td>
                <td>R$ {{$product['item']->price * $product['qtd']}}</td>
            </tr>
        @empty
            <p>Nenhum item no carrinho!</p>
        @endforelse
    </table>

    <div class="total-cart">R$ {{$cart->getTotal()}}</div>

    <div class="finish-card">
        <a href="{{route('method.payment')}}">Finalizar Compra <i class="fa fa-shopping-cart" aria-hidden="true"></i> </a>
    </div>
@endsection