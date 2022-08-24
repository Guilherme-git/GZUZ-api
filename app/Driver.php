<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'transporter',
        'phone',
        'email',
        'position',
        'address',
        'city',
        'state',
        'country',
        'status',
        'vehicle',
        'vehicle_status',
        'password',
        'latitude',
        'longitude',
        'zip',
        'document_driver_license',
        'document_vehicle_insurance',
        'sta',
    ];

    protected $hidden = [
        'password',
    ];

}
