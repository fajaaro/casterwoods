<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategory;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('restricted')->only(['index', 'show']);
        $this->middleware(['auth:api', 'admin'])->only(['store']);
    }

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

    public function store(StoreCategory $request)
    {
        $newCategory = Category::create($request->all());

        $category = new CategoryResource(
            Category::find($newCategory->id)
        ); 

        return response()->json([
            'status' => 'Success create new category!',
            'category' => $category,
        ]);
    }   

    public function show($id)
    {
        $category = new CategoryResource(
            Category::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get category data!',
            'category' => $category,
        ]); 
    }
}
