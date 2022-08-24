<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefuseOrder extends Model
{
    protected $table = 'refuse_order';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'order',
        'driver'
    ];
}
