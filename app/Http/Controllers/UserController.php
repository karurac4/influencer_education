<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //  login 表示
    public function login() {
        return view('login');
    }

     //  register に移動
     public function register() {
        return view('register');
    }

    //  register 表示
    // public function register() {
    //     return view('register');
    // }





}
