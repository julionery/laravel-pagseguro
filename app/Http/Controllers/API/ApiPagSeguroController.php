<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PagSeguro;
use App\Models\Order;

class ApiPagSeguroController extends Controller
{
    public function request(Request $request, PagSeguro $pagseguro, Order $order)
    {
        if(!$request->notificationCode)
            return response()->json(['error' => 'NotNotificationCode'], 404);

        $response = $pagseguro->getStatusTransaction($request->notificationCode);

        $order = $order->where('reference', $response['reference'])->get()->first();
        $order->changeStatus($response['status']);

        return response()->json(['success' => true]);
    }
}
