<?php 

namespace App\Traits;

use App\User;

trait AdminValidation
{
	public function checkToken($token)
	{
		$user = User::where('api_token', $token)->first();

		return $user->is_admin;
	}
}