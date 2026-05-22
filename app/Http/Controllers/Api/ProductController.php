<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query=Product::with('category');
        //Search
        if($request->search)
            {
                $query->where('name','like','%'.$request->search.'%');
            }
            // Filter by category
            if($request->category_id)
                {
                    $query->where('category_id',$request->category_id);
                }
                return response()->json(
                    [
                        'message'=>'success',
                        'data'=>$query->get()
                    ]
                );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image'))
            {
                $path=$request->file('image')->store('product','public');
                $data['image'] = $path;
            }

  
    $product = Product::create($data);

    return response()->json([
        'message' => 'success',
        'data' => $product
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
         return response()->json([
        'message' => 'success',
        'data' => $product->load('category')
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

    return response()->json([
        'message' => 'updated',
        'data' => $product
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Product $product)
{
    $product->delete();

    return response()->json([
        'message' => 'deleted'
    ]);
}
}
