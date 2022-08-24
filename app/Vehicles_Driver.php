<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicles_Driver extends Model
{
    protected $table = 'vehicles_drivers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'vehicle',
        'driver',
    ];
}
