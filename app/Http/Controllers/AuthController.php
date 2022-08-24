<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $user = User::where('email', '=', $request->email)
            ->where('password', '=', md5($request->password))
            ->get();

        if (count($user) > 0) {
            return response()->json(['user' => $user->get(0), 'type' => 'user']);
        } else {
            $driver = Driver::where('email', '=', $request->email)
                ->where('password', '=', md5($request->password))
                ->get();

            if (count($driver) > 0) {
                return response()->json(['driver' => $driver->get(0), 'type' => 'driver']);
            } else {
                return response()->json(['message' => 'No registered user']);
            }
        }
    }
}
