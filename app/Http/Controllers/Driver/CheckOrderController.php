<?php

namespace App\Http\Controllers\Driver;

use App\CheckOrder;
use App\Http\Controllers\Controller;
use App\Negotiation;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckOrderController extends Controller
{
    public function create(Request $request)
    {
        $check = new CheckOrder();
        $check->date = $request->date;
        $check->time = $request->time;
        $check->location = $request->location;
        $check->order = $request->order;
        $check->driver = $request->driver;
        if ($request->has('attach_docs') && $request->attach_docs != '' && strpos($request->attach_docs, ';base64')) {
            $base64 = $request->attach_docs;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'attach_docs';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $check->attach_docs = "$path/$path.$name";
        }
        if ($request->has('attach_pictures_of_the_cargo') && $request->attach_pictures_of_the_cargo != '' && strpos($request->attach_pictures_of_the_cargo, ';base64')) {
            $base64 = $request->attach_pictures_of_the_cargo;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'attach_pictures_of_the_cargo';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $check->attach_pictures_of_the_cargo = "$path/$path.$name";
        }
        if ($request->has('signature') && $request->signature != '' && strpos($request->signature, ';base64')) {
            $base64 = $request->signature;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'signature';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $check->signature = "$path/$path.$name";
        }
        $check->save();

        $order = Order::find($request->order);
        $order->status = 'Concluded';
        $order->save();

        $negotiation = Negotiation::where('order','=',$request->order)
            ->where('driver','=',$request->driver)
            ->get();

        $negotiationUpdate = Negotiation::find($negotiation->get(0)->id);
        $negotiationUpdate->status = 'Concluded';
        $negotiationUpdate->save();

        return response()->json(['message' => "Create"]);
    }
}
