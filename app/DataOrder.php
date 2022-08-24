<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataOrder extends Model
{
    protected $table = 'data_order_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'load',
        'image',
        'base64',
        'height',
        'width',
        'depth',
        'weight',
        'inchOrCentimeter',
        'lbsOrKgs',
        'order_details',
    ];
}
