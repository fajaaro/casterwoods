<?php 

namespace App\Traits;

use App\User;

trait AdminValidation
{
	public function checkBearerToken($bearerToken)
	{
		$user = User::where('api_token', $bearerToken)->first();

		return $user->is_admin;
	}
}