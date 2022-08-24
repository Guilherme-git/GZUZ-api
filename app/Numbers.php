<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    protected $table = 'numbers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'number'
    ];
}
