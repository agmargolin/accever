<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function addPackage(Request $request)
    {
        $user = new User();

        $users_array = $request->input('users');
        $accesses_array = $request->input('accesses');

        foreach($users_array as $user_id) {
            $user->id = $user_id;
            $user->accesses()->sync($accesses_array, false);
        }

        return true;

    }

    public function getUser()
    {
        $obj = new User();
        
        return $obj->getId();

    }
}
