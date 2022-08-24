<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Messages;
use App\Negotiation;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function viewMessages(Request $request)
    {
        $messages = Messages::where('order', '=', $request->order)
            ->where('user', '=', $request->user)
            ->with('driver')
            ->get();

        $negations = Negotiation::where('order', '=', $request->order)
            ->get();

        foreach ($messages as $m) {
            $messagesUpdate = Messages::find($m->id);
            $messagesUpdate->status = 0;
            $messagesUpdate->save();
        }
        return response()->json(['messages'=>$messages, "negations"=>$negations]) ;
    }
}
