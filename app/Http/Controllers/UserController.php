<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function getUserActive(Request $request)
	{
	    return response()->json([
	    	'user' => $request->user(),
	    	'status' => 'Success!',
	    ]);
	}
}
