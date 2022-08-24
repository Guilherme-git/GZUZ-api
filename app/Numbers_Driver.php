<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numbers_Driver extends Model
{
    protected $table = 'numbers_drivers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'number',
        'driver',
    ];
}
