<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User_Secundary;
use Illuminate\Http\Request;

class UserSecundary extends Controller
{
    public function create(Request $request)
    {
        $userSecundary = new User_Secundary();
        $userSecundary->name = $request->name;
        $userSecundary->email = $request->email;
        $userSecundary->phone = $request->phone;
        $userSecundary->user = $request->user;
        $userSecundary->save();

        return response()->json(['message'=>"Create"]);
    }
}

