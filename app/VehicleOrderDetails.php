<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleOrderDetails extends Model
{
    protected $table = 'vehicles_order_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'order_details',
        'vehicle',
    ];

}
