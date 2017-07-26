<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function accesses()
    {
        return $this->belongsToMany('App\Access', 'packages_accesses', 'package_id', 'access_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'packages_users', 'package_id', 'user_id');
    }
}
