<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'cargo_docs',
        'volume',
        'total_weight',
        'purchase_order',
        'total_objects',
        'observation'
    ];

    public function vehicles_order_details()
    {
        return $this->hasMany(VehicleOrderDetails::class,'order_details','id');
    }

    public function data_order_details()
    {
        return $this->hasMany(DataOrder::class,'order_details','id');
    }
}
