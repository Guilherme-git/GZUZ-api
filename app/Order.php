<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'status',
        'pickup_details',
        'delivery_details',
        'order_details',
        'latitude',
        'longitude',
        'user',
        'driver'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class,'id','driver');
    }

    public function messages()
    {
        return $this->hasMany(Messages::class,'order','id');
    }

    public function pickup_details()
    {
        return $this->hasOne(PickupDetails::class,'id','pickup_details');
    }

    public function delivery_details()
    {
        return $this->hasOne(DeliveryDetails::class,'id','delivery_details');
    }

    public function order_details()
    {
        return $this->hasOne(OrderDetails::class,'id','order_details');
    }

    public function negotiation()
    {
        return $this->hasOne(Negotiation::class,'order','id');
    }
}
