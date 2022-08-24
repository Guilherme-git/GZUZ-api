<?php

namespace App\Http\Controllers;

use App\Vehicles;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function create(Request $request)
    {
        $vehicle = new Vehicles();
        $vehicle->model = $request->model;
        $vehicle->length = "L".$request->length;
        $vehicle->height = "H".$request->height;
        $vehicle->width = "W".$request->width;
        $vehicle->weight = "".$request->weight;
        $vehicle->image = $request->file('image')->store('image_vehicles');
        $vehicle->save();

        if($vehicle)
        {
            return response()->json(['message' => 'create']);
        }
    }

    public function list()
    {
        $vehicles = Vehicles::all();
        return $vehicles;
    }
}
