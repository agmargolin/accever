<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    /**
     * @return array
     */
    public function accesses()
    {
        return $this->belongsTo('App\Access', 'access_id');
    }

    /**
     * @return array
     */
    public function authors()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * @return array
     */
    public function changers()
    {
        return $this->belongsTo('App\User', 'user_changeme_id');
    }


    /**
     * @return array
     */
    public function projects()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
