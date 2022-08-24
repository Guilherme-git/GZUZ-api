<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetails extends Model
{
    protected $table = 'delivery_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'company',
        'contact',
        'email',
        'phone',
        'address',
        'suite',
        'date',
        'city',
        'state',
        'zip',
        'latitude',
        'longitude'
    ];
}
