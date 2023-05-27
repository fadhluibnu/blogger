<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Category::all()->load('posts');
        $getAllCategory = CategoryResource::collection(Category::all()->load('posts'));
        
        return response()->json([
            'status' => 200,
            'data' => $getAllCategory->isEmpty() ? null : $getAllCategory
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('image_category');

        $storeCategory = Category::create($validated);
        return $storeCategory ? response()->json([
            'status' => 200,
            'message' => 'uploaded',
            'data' => $storeCategory
        ], 200) : response()->json([
            'status' => 400,
            'message' => 'failed',
            'data' => null
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
        $validated = $request->validated();
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('image_category');
        }

        $getDataCategory = Category::where('slug', $slug)->first();
        $updateCategory = $getDataCategory ? $getDataCategory->update($validated) : false;

        return $getDataCategory == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($updateCategory ? response()->json([
            'status' => 200,
            'message' => 'success'
        ], 200) : response()->json([
            'status' => 500,
            'message' => 'failed'
        ], 500));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
