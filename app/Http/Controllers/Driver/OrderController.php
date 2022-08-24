<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Order;
use App\Show_Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $ordens = Order::where('status','=','Open request')
            ->orderBy('id','DESC')
            ->with('pickup_details')
            ->with('delivery_details')
            ->with('order_details')
            ->with('order_details.vehicles_order_details')
            ->with('order_details.data_order_details')
            ->with('user')
            ->get();

        return $ordens;
    }

    public function myOrdens(Request $request)
    {
        $ordens = Order::where('driver', '=', $request->idDriver)
            ->with('user')
            ->with('pickup_details')
            ->with('delivery_details')
            ->with('order_details')
            ->with('order_details.vehicles_order_details')
            ->with('order_details.data_order_details')
            ->with('messages')
            ->get();

        return $ordens;
    }
}
