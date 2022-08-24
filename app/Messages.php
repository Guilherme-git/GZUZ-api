<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'order',
        'user',
        'driver',
        'identification',
        'status'
    ];

    public function order()
    {
        return $this->hasOne(Order::class,'id','order');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class,'id','driver');
    }
}
