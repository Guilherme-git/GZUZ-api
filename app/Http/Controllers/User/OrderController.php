<?php

namespace App\Http\Controllers\User;

use App\DataOrder;
use App\DeliveryDetails;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use App\PickupDetails;
use App\VehicleOrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $pickup_details = new PickupDetails();
        $pickup_details->bill = $request->pickupDetails['bill'];
        $pickup_details->company = $request->pickupDetails['company'];
        $pickup_details->contact = $request->pickupDetails['contact'];
        $pickup_details->email = $request->pickupDetails['email'];
        $pickup_details->phone = $request->pickupDetails['phone'];
        $pickup_details->address = $request->pickupDetails['address'];
        $pickup_details->suite = $request->pickupDetails['suite'];
        $pickup_details->date = date('Y-m-d',strtotime($request->pickupDetails['date']));
        $pickup_details->timeOpen = $request->pickupDetails['timeOpen'];
        $pickup_details->timeClose = $request->pickupDetails['timeClose'];
        $pickup_details->city = $request->pickupDetails['city'];
        $pickup_details->state = $request->pickupDetails['state'];
        $pickup_details->zip = $request->pickupDetails['zip'];
        $pickup_details->latitude = $request->pickupDetails['latitude'];
        $pickup_details->longitude = $request->pickupDetails['longitude'];
        $pickup_details->save();

        $delivery_details = new DeliveryDetails();
        $delivery_details->company = $request->deliveryDetails['company'];
        $delivery_details->contact = $request->deliveryDetails['contact'];
        $delivery_details->email = $request->deliveryDetails['email'];
        $delivery_details->phone = $request->deliveryDetails['phone'];
        $delivery_details->address = $request->deliveryDetails['address'];
        $delivery_details->suite = $request->deliveryDetails['suite'];
        $delivery_details->date = date('Y-m-d', strtotime($request->deliveryDetails['date'])) ;
        $delivery_details->city = $request->deliveryDetails['city'];
        $delivery_details->state = $request->deliveryDetails['state'];
        $delivery_details->zip = $request->deliveryDetails['zip'];
        $delivery_details->latitude = $request->deliveryDetails['latitude'];
        $delivery_details->longitude = $request->deliveryDetails['longitude'];
        $delivery_details->save();

        $order_details = new OrderDetails();
        $order_details->cargo_docs = $request->orderDetails['cargo_docs'];
        $order_details->observation = $request->orderDetails['observation'];
        $order_details->purchase_order = $request->orderDetails['purchase_order'];
        $order_details->volume = $request->orderDetails['volume'];
        $order_details->total_weight = $request->orderDetails['total_weight'];
        $order_details->total_objects = $request->orderDetails['total_objects'];
        $order_details->save();

        if (count($request->orderDetails['data_order_details']) > 0) {
            foreach ($request->orderDetails['data_order_details'] as $key => $or) {
                $data_order = new DataOrder();
                if ($or['base64'] != '' && $or['base64'] != null && strpos($or['base64'], ';base64')) {
                    $base64 = $or['base64'];

                    //obtem a extensão
                    $extension = explode('/', $base64);
                    $extension = explode(';', $extension[1]);
                    $extension = '.' . $extension[0];

                    //gera o nome
                    $name = time() . $key . $extension;

                    //obtem o arquivo
                    $separatorFile = explode(',', $base64);
                    $file = $separatorFile[1];
                    $path = 'image_load';

                    //envia o arquivo
                    Storage::put("$path/$path.$name", base64_decode($file));

                    $data_order->image = "$path/$path.$name";
                    $data_order->base64 = $base64;
                }
                $data_order->load = $or['load'];
                $data_order->height = $or['height'];
                $data_order->width = $or['width'];
                $data_order->depth = $or['depth'];
                $data_order->weight = $or['weight'];
                $data_order->inchOrCentimeter = $or['inchOrCentimeter'];
                $data_order->lbsOrKgs = $or['lbsOrKgs'];
                $data_order->order_details = $order_details->id;
                $data_order->save();
            }
        }

        if (count($request->orderDetails['vehicles_order_details']) > 0) {
            foreach ($request->orderDetails['vehicles_order_details'] as $ve) {
                $vehicle_order_details = new VehicleOrderDetails();
                $vehicle_order_details->order_details = $order_details->id;
                $vehicle_order_details->vehicle = $ve['vehicle'];
                $vehicle_order_details->save();
            }
        }

        $order = new Order();
        $order->status = "Open request";
        $order->pickup_details = $pickup_details->id;
        $order->delivery_details = $delivery_details->id;
        $order->order_details = $order_details->id;
        $order->latitude = $request->latitude;
        $order->longitude = $request->longitude;
        $order->user = $request->user;
        $order->save();

        return response()->json(['message' => "Create"]);
    }

    public function edit(Request $request)
    {
        $order = Order::where('id','=',$request->order)->get();

        foreach ($order as $key => $or)
        {
            $orderUpdate = Order::find($or->id);
            $orderUpdate->latitude = $request->latitude;
            $orderUpdate->longitude = $request->longitude;
            $orderUpdate->save();

            $pickup_details = PickupDetails::find($or->pickup_details);
            $pickup_details->bill = $request->pickupDetails['bill'];
            $pickup_details->company = $request->pickupDetails['company'];
            $pickup_details->contact = $request->pickupDetails['contact'];
            $pickup_details->email = $request->pickupDetails['email'];
            $pickup_details->phone = $request->pickupDetails['phone'];
            $pickup_details->address = $request->pickupDetails['address'];
            $pickup_details->suite = $request->pickupDetails['suite'];
            $pickup_details->date = $request->pickupDetails['date'];
            $pickup_details->timeOpen = $request->pickupDetails['timeOpen'];
            $pickup_details->timeClose = $request->pickupDetails['timeClose'];
            $pickup_details->city = $request->pickupDetails['city'];
            $pickup_details->state = $request->pickupDetails['state'];
            $pickup_details->zip = $request->pickupDetails['zip'];
            $pickup_details->latitude = $request->pickupDetails['latitude'];
            $pickup_details->longitude = $request->pickupDetails['longitude'];
            $pickup_details->save();

            $delivery_details = DeliveryDetails::find($or->delivery_details);
            $delivery_details->company = $request->deliveryDetails['company'];
            $delivery_details->contact = $request->deliveryDetails['contact'];
            $delivery_details->email = $request->deliveryDetails['email'];
            $delivery_details->phone = $request->deliveryDetails['phone'];
            $delivery_details->address = $request->deliveryDetails['address'];
            $delivery_details->suite = $request->deliveryDetails['suite'];
            $delivery_details->date = $request->deliveryDetails['date'];
            $delivery_details->city = $request->deliveryDetails['city'];
            $delivery_details->state = $request->deliveryDetails['state'];
            $delivery_details->zip = $request->deliveryDetails['zip'];
            $delivery_details->latitude = $request->deliveryDetails['latitude'];
            $delivery_details->longitude = $request->deliveryDetails['longitude'];
            $delivery_details->save();

            $order_details = OrderDetails::find($or->order_details);
            $order_details->cargo_docs = $request->orderDetails['cargo_docs'];
            $order_details->observation = $request->orderDetails['observation'];
            $order_details->purchase_order = $request->orderDetails['purchase_order'];
            $order_details->volume = $request->orderDetails['volume'];
            $order_details->total_weight = $request->orderDetails['total_weight'];
            $order_details->total_objects = $request->orderDetails['total_objects'];
            $order_details->save();

            if (count($request->orderDetails['vehicles_order_details']) > 0) {

                $vehicle_order_details = VehicleOrderDetails::where('order_details','=',$or->order_details)->get();
                foreach ($vehicle_order_details as $vh)
                {
                    $vehicle = VehicleOrderDetails::find($vh->id);
                    $vehicle->delete();
                }

                foreach ($request->orderDetails['vehicles_order_details'] as $ve) {
                    $vehicle_order_details = new VehicleOrderDetails();
                    $vehicle_order_details->order_details = $or->order_details;
                    $vehicle_order_details->vehicle = $ve['vehicle'];
                    $vehicle_order_details->save();
                }
            }
            if (count($request->orderDetails['data_order_details']) > 0) {
                $data_orders = DataOrder::where('order_details','=',$or->order_details)->get();

                foreach ($data_orders as $dt)
                {
                    Storage::delete($dt->image);
                    $data = DataOrder::find($dt->id);
                    $data->delete();
                }

                foreach ($request->orderDetails['data_order_details'] as $key => $or) {

                    $data_order = new DataOrder();
                    if ($or['base64'] != '' && $or['base64'] != null && strpos($or['base64'], ';base64')) {
                        $base64 = $or['base64'];

                        //obtem a extensão
                        $extension = explode('/', $base64);
                        $extension = explode(';', $extension[1]);
                        $extension = '.' . $extension[0];

                        //gera o nome
                        $name = time() . $key . $extension;

                        //obtem o arquivo
                        $separatorFile = explode(',', $base64);
                        $file = $separatorFile[1];
                        $path = 'image_load';

                        //envia o arquivo
                        Storage::put("$path/$path.$name", base64_decode($file));

                        $data_order->image = "$path/$path.$name";
                        $data_order->base64 = $base64;
                    }
                    $data_order->load = $or['load'];
                    $data_order->height = $or['height'];
                    $data_order->width = $or['width'];
                    $data_order->depth = $or['depth'];
                    $data_order->weight = $or['weight'];
                    $data_order->inchOrCentimeter = $or['inchOrCentimeter'];
                    $data_order->lbsOrKgs = $or['lbsOrKgs'];
                    $data_order->order_details = $order_details->id;
                    $data_order->save();
                }
            }
        }
        return response()->json(['message' => "Create"]);
    }

    public function driverMap(Request $request)
    {
//        $ordens = Order::where('user', '=', $request->idUser)
//            ->whereIn('status', ["Open request","In progress"])
//            ->get();
//
//        return $ordens;

        $drivers = Driver::all();
        return $drivers;
    }

    public function myOrdens(Request $request)
    {
        $ordens = Order::where('user', '=', $request->idUser)
            ->with('driver')
            ->with('pickup_details')
            ->with('delivery_details')
            ->with('order_details')
            ->with('order_details.vehicles_order_details')
            ->with('order_details.data_order_details')
            ->with('messages')
            ->get();

        return $ordens;
    }
}
