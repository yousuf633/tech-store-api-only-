<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return response()->json([
            'message'=>'success',
            'data'=>Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreCategoryRequest $request)
{
   $category=Category::create($request->validated());

    return response()->json([
        'message' => 'created(stored)',
        'data' => $category
    ], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'message'=>'showed',
            'data'=>$category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
{
    $category->update($request->validated());

    return response()->json([
        'message' => 'updated',
        'data' => $category
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
