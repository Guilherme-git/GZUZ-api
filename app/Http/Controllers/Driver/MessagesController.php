<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Messages;
use App\Negotiation;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function save(Request $request)
    {
        $messages = Messages::where('order', '=', $request->order)
            ->where('user', '=', $request->user)
            ->where('driver', '=', $request->driver)
            ->get();

        $negotiation = Negotiation::where('order', '=', $request->order)
            ->where('driver', '=', $request->driver)
            ->get();

        if (count($negotiation) == 0) {
            $negotiation = new Negotiation();
            $negotiation->driver = $request->driver;
            $negotiation->order = $request->order;
            $negotiation->status = "Pending";
            $negotiation->save();
        } else {
            $negotiationUp = Negotiation::find($negotiation->get(0)->id);
            $negotiationUp->status = "Pending";
            $negotiationUp->save();
        }


        if (count($messages) === 0) {
            $messages = new Messages();
            $messages->order = $request->order;
            $messages->driver = $request->driver;
            $messages->user = $request->user;
            $messages->identification = $request->order + $request->driver + $request->user;
            $messages->status = 1;
            $messages->save();
        } else {
            $messagesUpdate = Messages::find($messages->get(0)->id);
            $messagesUpdate->status = $messages->get(0)->status + 1;
            $messagesUpdate->save();
        }
    }

    public function saveQuick(Request $request)
    {
        $messages = Messages::where('order', '=', $request->order)
            ->where('user', '=', $request->user)
            ->where('driver', '=', $request->driver)
            ->get();

        $negotiation = Negotiation::where('order', '=', $request->order)
            ->where('driver', '=', $request->driver)
            ->get();

        $negotiationUp = Negotiation::find($negotiation->get(0)->id);
        $negotiationUp->status = "Im here";
        $negotiationUp->save();

        if (count($messages) === 0) {
            $messages = new Messages();
            $messages->order = $request->order;
            $messages->driver = $request->driver;
            $messages->user = $request->user;
            $messages->identification = $request->order + $request->driver + $request->user;
            $messages->status = 1;
            $messages->save();
        } else {
            $messagesUpdate = Messages::find($messages->get(0)->id);
            $messagesUpdate->status = $messages->get(0)->status + 1;
            $messagesUpdate->save();
        }
    }
}
