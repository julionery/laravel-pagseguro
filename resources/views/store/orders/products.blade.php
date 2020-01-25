@extends('store.layouts.main')

@section('content')
    <h1 class="title">Produtos da Ordem {{$order->reference}}</h1>

    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço</th>
        </tr>

        @forelse($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->qty}}</td>
                <td>{{$product->pivot->price}}</td>
            </tr>
        @empty
            <p>Nenhum Pedido!</p>
        @endforelse

    </table>
@endsection