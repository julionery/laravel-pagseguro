@extends('store.layouts.main')

@section('content')
    <h1 class="title">Meus Pedidos</h1>

    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Reference</th>
            <th>Status</th>
            <th>Forma de Pagamento</th>
            <th>Data</th>
            <th>Data Atualização</th>
        </tr>

        @forelse($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>
                    <a href="{{route('order.details', $order->reference)}}">
                        {{$order->reference}}
                    </a>
                </td>
                <td>{{$order->getStatus($order->status)}}</td>
                <td>{{$order->getPaymentMethod($order->payment_method)}}</td>
                <td>{{$order->date}}</td>
                <td>{{$order->date_refresh_status}}</td>
            </tr>
        @empty
            <p>Nenhum Pedido!</p>
        @endforelse

    </table>
@endsection