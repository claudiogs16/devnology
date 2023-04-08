<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAllUser(){
        $users = User::all();
        return $users->toJson();

        // return 'Users';
    }

    public function showUser($id){
        $user = User::find($id);
        return $user;
    }





}
