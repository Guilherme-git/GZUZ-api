<?php

namespace App\Http\Controllers\Driver;

use App\Companies;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Numbers;
use App\Numbers_Driver;
use App\Vehicles_Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function create(Request $request)
    {

        $driver = new Driver();
        $driver->name = $request->name;
        $driver->transporter = $request->transporter;
        $driver->phone = $request->phone;
        $driver->email = $request->email;
        $driver->address = $request->address;
        $driver->position = $request->position;
        $driver->city = $request->city;
        $driver->state = $request->state;
        $driver->country = $request->country;
        $driver->status = $request->status;
        $driver->vehicle = $request->vehicle;
        $driver->latitude = $request->latitude;
        $driver->longitude = $request->longitude;
        $driver->zip = $request->zip;
        $driver->vehicle_status = $request->vehicle_status;

        if ($request->has('document_driver_license') && $request->document_driver_license != '' && strpos($request->document_driver_license, ';base64')) {
            $base64 = $request->document_driver_license;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'document_driver_license';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $driver->document_driver_license = "$path/$path.$name";

        }
        if ($request->has('document_vehicle_insurance') && $request->document_vehicle_insurance != '' && strpos($request->document_vehicle_insurance, ';base64')) {
            $base64 = $request->document_vehicle_insurance;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'document_vehicle_insurance';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $driver->document_vehicle_insurance = "$path/$path.$name";

        }
        if ($request->has('sta') && $request->sta != '' && strpos($request->sta, ';base64')) {
            $base64 = $request->sta;

            //obtem a extensão
            $extension = explode('/', $base64);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];

            //gera o nome
            $name = time() . $extension;

            //obtem o arquivo
            $separatorFile = explode(',', $base64);
            $file = $separatorFile[1];
            $path = 'sta';

            //envia o arquivo
            Storage::put("$path/$path.$name", base64_decode($file));

            $driver->sta = "$path/$path.$name";

        }
        $driver->password = md5($request->password);
        $driver->save();

        if ($driver) {
            if (count($request->companys) > 0) {
                foreach ($request->companys as $c) {
                    $company = new Companies();
                    $company->name = $c['label'];
                    $company->ein = $c['ein'];
                    $company->address = $c['address'];
                    $company->driver = $driver->id;
                    $company->save();
                }
            }
            if (count($request->numbers) > 0) {
                foreach ($request->numbers as $n) {
                    $numbers = new Numbers_Driver();
                    $numbers->number = $n['id'];
                    $numbers->driver = $driver->id;
                    $numbers->save();
                }
            }
            if (count($request->vehicles) > 0) {
                foreach ($request->vehicles as $v) {
                    $vehicle = new Vehicles_Driver();
                    $vehicle->vehicle = $v['id'];
                    $vehicle->driver = $driver->id;
                    $vehicle->save();
                }
            }
            return response()->json(['message' => 'create']);
        } else {
            return response()->json(['message' => 'create']);
        }
    }
}
