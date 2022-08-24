<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    protected $table = 'negotiation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'order',
        'driver',
        'value',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class,'id','driver');
    }
}
