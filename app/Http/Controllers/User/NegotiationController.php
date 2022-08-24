<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Negotiation;
use App\Order;
use Illuminate\Http\Request;

class NegotiationController extends Controller
{
    public function accept(Request $request)
    {
        $negotiation = Negotiation::where('order', '=', $request->order)
            ->where('driver', '=', $request->driver)
            ->get();

        $negotiationRecused= Negotiation::where('order', '=', $request->order)
            ->get();

        foreach ($negotiationRecused as $n) {
            $negotiationUpdate = Negotiation::find($n->id);
            $negotiationUpdate->status = "Recused";
            $negotiationUpdate->save();
        }


        $negotiationUpdate = Negotiation::find($negotiation->get(0)->id);
        $negotiationUpdate->status = "Accept";
        $negotiationUpdate->save();

        $order = Order::find($request->order);
        $order->status = "In progress";
        $order->driver = $request->driver;
        $order->save();

        return response()->json(['message' => "Accept"]);
    }

    public function recused(Request $request)
    {
        $negotiation = Negotiation::find($request->id);
        $negotiation->status = "Recused";
        $negotiation->save();

        return response()->json(['message' => "Recused"]);
    }
}
