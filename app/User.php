<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'id', 'companie', 'name', 'email', 'password','phone','address','city','state','country','cep','latitude','longitude'
    ];


    protected $hidden = [
        'password',
    ];

}
