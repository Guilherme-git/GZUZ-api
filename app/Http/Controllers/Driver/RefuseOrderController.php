<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\RefuseOrder;
use Illuminate\Http\Request;

class RefuseOrderController extends Controller
{
    public function create(Request $request)
    {
        $refuseOrder = new RefuseOrder();
        $refuseOrder->driver = $request->driver;
        $refuseOrder->order = $request->order;
        $refuseOrder->save();

        return response()->json(['message'=>"Create"]);
    }

    public function myRefuse(Request $request)
    {
        $refuseOrders = RefuseOrder::where('driver','=',$request->idDriver)->get();
        return $refuseOrders;
    }
}
