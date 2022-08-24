<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Secundary extends Model
{
    protected $table = 'users_secundary';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'user'
    ];
}
