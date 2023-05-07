<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use auth;
use rolecheck;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rolecheck');
    }
	function all_user(){
        return view("users", [
			'users' => User::all()
		]);
    }
}
