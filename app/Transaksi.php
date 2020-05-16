<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function outlets()
    {
        return $this->belongsToMany('App\Outlet');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users');
    }
}
