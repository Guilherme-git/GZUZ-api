<?php

namespace App\Http\Controllers;

use App\Numbers;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function create(Request $request)
    {
        $number = new Numbers();
        $number->number = $request->number;
        $number->save();

        if($number) {
            return response()->json(['message' => 'create']);
        }
    }

    public function list()
    {
        $numbers = Numbers::all();
        return $numbers;
    }
}
