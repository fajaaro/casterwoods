<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\AdminValidation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    use AdminValidation;

    public function validateAPIToken($token)
    {
		return response()->json([
			'is_admin' => $this->checkToken($token),
		]);
    }
}
