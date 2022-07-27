<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        return view('test.test');
    }
    public function login(){
        return view('test.login');
    }
    public function register(){
        return view('test.register');
    }
    public function feature(){
        return view('test.newFeature');
    }
    
}
