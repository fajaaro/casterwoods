<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function index()
	{
		$categories = CategoryResource::collection(
            Category::all()
        );

        return response()->json([
            'status' => 'Success get all categories data!',
            'categories' => $categories,
        ]);
	}   
}
