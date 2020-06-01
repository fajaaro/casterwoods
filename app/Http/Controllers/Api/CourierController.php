<?php

namespace App\Http\Controllers\Api;

use App\Courier;
use App\Http\Controllers\Controller;
use App\Http\Resources\Courier as CourierResource;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('restricted')->only(['index']);        
    }

    public function index()
    {
    	$couriers = CourierResource::collection(
            Courier::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all courier data!',
            'couriers' => $couriers,
        ]);
    }
}
