<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sendEmail(Request $request)
    {
        $user = User::where('email', '=', $request->email)
            ->get();

        if (count($user) > 0) {
            session()->put('email', $request->email);
            Mail::send('alterar-senha-email', ["email" => "enviado"], function ($e) {
                $e->from('envio@contetecnologia.com.br', 'GZUZ');
                $e->subject("Alterar sua senha");
                $e->to(session()->get('email'));
            });

            return response()->json(['message' => 'Send email','email'=>$request->email]);
        } else {
            $driver = Driver::where('email', '=', $request->email)
                ->get();

            if (count($driver) > 0) {
                session()->put('email', $request->email);
                Mail::send('alterar-senha-email', ["email" => "enviado"], function ($e) {
                    $e->from('envio@contetecnologia.com.br', 'GZUZ');
                    $e->subject("Alterar sua senha");
                    $e->to(session()->get('email'));
                });

                return response()->json(['message' => 'Send email','email'=>$request->email]);
            } else {
                return response()->json(['message' => 'No registered user']);
            }
        }
    }

    public function newPassword(Request $request)
    {

        $user = User::where('email', '=', $request->email)
            ->get();

        if (count($user) > 0) {
           $userN = User::find($user->get(0)->id);
           $userN->password = md5($request->password);
           $userN->save();

            return response()->json(['message' => 'New password']);
        } else {
            $driver = Driver::where('email', '=', $request->email)
                ->get();

            if (count($driver) > 0) {
                $driverN = User::find($driver->get(0)->id);
                $driverN->password = md5($request->password);
                $driverN->save();

                return response()->json(['message' => 'New password']);
            }
        }
    }
}
