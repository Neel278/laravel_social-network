<?php

namespace App;

use Illuminate\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use AuthAuthenticatable;
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
