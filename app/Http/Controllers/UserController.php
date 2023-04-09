<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){


        try {
            $users = User::all();

            if($users)
            return $users->toJson();

            return 'Nenhum usuario registrado no sistema!!';
        } catch (\Throwable $th) {
           return $tr;
        }


    }

    public function show($id){
        try {
            $user = User::find($id);

            if($user)
            return json_encode($user);

            return "Usuario não existe!!";
        } catch (\Throwable $th) {
            return $th;
        }
    }





}
