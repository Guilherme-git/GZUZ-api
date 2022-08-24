<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancellations extends Model
{
    protected $table = 'cancellations';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'order',
        'reason'
    ];
}
