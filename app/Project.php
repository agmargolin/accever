<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function accesses()
    {
        return $this->hasMany('App\Access');
    }
}
