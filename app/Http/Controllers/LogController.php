<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    public function add(Request $request)
    {
        $obj = new Log;

        $obj->project_id = $request->project_id;
        $obj->scope = $request->scope;
        $obj->type = $request->type;
        $obj->url = $request->url;
        $obj->login = $request->login;
        $obj->password = $request->password;
        $obj->port = $request->port;
        $obj->service_name = $request->service_name;
        $obj->description = $request->description;
        $obj->author_id = $request->author_id;
        $obj->user_changeme_id = 0;
       // $obj->log_comment = $request->log_comment;

        if($obj->save()) return 'New log has been added.';
        
    }

}
