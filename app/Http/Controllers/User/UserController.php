<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\User_Secundary;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->companie = $request->companie;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->cep = $request->cep;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->password = md5($request->password);
        $user->save();

        if($user){
            if(count($request->users) > 0) {
                foreach ($request->users as $u) {
                    $userSecundary = new User_Secundary();
                    $userSecundary->name = $u['name'];
                    $userSecundary->email = $u['email'];
                    $userSecundary->phone = $u['phone'];
                    $userSecundary->user = $user->id;
                    $userSecundary->save();
                }
                if($userSecundary) {
                    return response()->json(['message' => 'create']);
                }
            } else {
                return response()->json(['message' => 'create']);
            }

        }
    }
}
