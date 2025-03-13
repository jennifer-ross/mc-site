<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(Request $request)
	{
		if (Auth::check() && Auth::user()) {
			Auth::logout();
		}

		return response()->redirectGuest('/');
	}
}
