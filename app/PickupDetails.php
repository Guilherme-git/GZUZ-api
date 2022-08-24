<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupDetails extends Model
{
    protected $table = 'pickup_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'bill',
        'company',
        'contact',
        'email',
        'phone',
        'address',
        'suite',
        'date',
        'timeOpen',
        'timeClose',
        'city',
        'state',
        'zip',
        'latitude',
        'longitude'
    ];
}
