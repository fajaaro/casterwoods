<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PremadeBoxCategory\StorePremadeBoxCategory;
use App\Http\Resources\PremadeBoxCategory as PremadeBoxCategoryResource;
use App\PremadeBoxCategory;
use Illuminate\Http\Request;

class PremadeBoxCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('restricted')->only(['index', 'show']);
        $this->middleware(['auth:api', 'admin'])->only(['store']);
    }

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

    public function store(StorePremadeBoxCategory $request)
    {
        $newCategory = PremadeBoxCategory::create($request->all());

        $category = new PremadeBoxCategoryResource(
            PremadeBoxCategory::find($newCategory->id)
        ); 

        return response()->json([
            'status' => 'Success create new premade box category!',
            'category' => $category,
        ]);        
    }

    public function show($id)
    {
        $premadeBoxCategory = new PremadeBoxCategoryResource(
            PremadeBoxCategory::withRelations()->where('id', $id)->first()
        );

        return response()->json([
            'status' => 'Success get premade box category data!',
            'premade_box_category' => $premadeBoxCategory,
        ]); 
    }
}
