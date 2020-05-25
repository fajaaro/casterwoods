<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PremadeBoxCategory as PremadeBoxCategoryResource;
use App\PremadeBoxCategory;
use Illuminate\Http\Request;

class PremadeBoxCategoryController extends Controller
{
    public function index()
    {
    	$premadeBoxCategories = PremadeBoxCategoryResource::collection(
            PremadeBoxCategory::withRelations()->get()
        );

        return response()->json([
            'status' => 'Success get all premade box categories data!',
            'premade_box_categories' => $premadeBoxCategories,
        ]);
    }
}
