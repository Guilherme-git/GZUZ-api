<?php

namespace App\Http\Controllers\User;

use App\Cancellations;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class CancellationsController extends Controller
{
    public function create(Request $request)
    {
        $cancel = new Cancellations();
        $cancel->order = $request->order;
        $cancel->reason = $request->reason;
        $status = $cancel->save();

        if($status) {
            $order = Order::find($request->order);
            $order->status = "Canceled";
            $order->save();

            return response()->json(['message'=>"Create"]);
        }
    }
}
