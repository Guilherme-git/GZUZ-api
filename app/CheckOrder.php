<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOrder extends Model
{
    protected $table = 'cheack_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'attach_docs',
        'attach_pictures_of_the_cargo',
        'signature',
        'date',
        'time',
        'location',
        'order',
        'driver',
    ];
}
