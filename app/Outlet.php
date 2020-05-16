<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use SoftDeletes;
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function pakets()
    {
        return $this->belongsToMany('App\Paket');
    }
    
}
