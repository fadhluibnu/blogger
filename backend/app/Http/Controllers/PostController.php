<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllPost = Post::all()->load('user');

        return response()->json([
            'status' => 200,
            'data' => $getAllPost->isEmpty() ? null : $getAllPost
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
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['image_cover'] = $request->file('image_cover')->store('image_post');

        $storePost = Post::create($validated);
        return $storePost ? response()->json([
            'status' => 200,
            'message' => 'uploaded',
            'data' => $storePost
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
    public function show($slug)
    {
        $getPostBySlug = Post::where('slug', $slug)->first();
        return $getPostBySlug ? response()->json([
            'status' => 200,
            'message' => 'succes',
            'data' => $getPostBySlug
        ], 200) : response()->json([
            'status' => 404,
            'message' => 'not found',
            'data' => null
        ], 404);
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
    public function update(UpdatePostRequest $request, $slug)
    {
        $validated = $request->validated();
        if ($request->file('image_cover')) {
            $validated['image_cover'] = $request->file('image_cover')->store('image_post');
        }
        
        $getDataPost = Post::where('slug', $slug)->first();
        $updatePost = $getDataPost ? $getDataPost->update($validated) : false;


        return $getDataPost == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($updatePost ? response()->json([
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
