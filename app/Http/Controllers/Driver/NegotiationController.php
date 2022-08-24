<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Negotiation;
use Illuminate\Http\Request;

class NegotiationController extends Controller
{
    public function create(Request $request)
    {
        $negotiation = Negotiation::where('order', '=', $request->order)
            ->where('driver', '=', $request->driver)
            ->get();

        if (count($negotiation) == 0) {
            $negotiation = new Negotiation();
            $negotiation->order = $request->order;
            $negotiation->driver = $request->driver;
            $negotiation->value = $request->value;
            $negotiation->status = "Pending";
            $negotiation->save();
        } else {
            $negotiationUpdate = Negotiation::find($negotiation->get(0)->id);
            $negotiationUpdate->value = $request->value;
            $negotiationUpdate->status = "Pending";
            $negotiationUpdate->save();
        }


        return response()->json(['message' => "Create"]);
    }
}
