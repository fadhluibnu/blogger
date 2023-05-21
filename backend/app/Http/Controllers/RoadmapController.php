<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreRoadmapRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllRoadmap = Roadmap::all()->load('tutorials');

        return response()->json([
            'status' => 200,
            'data' => $getAllRoadmap->isEmpty() ? null : $getAllRoadmap
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
    public function store(StoreRoadmapRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('image_roadmap');

        $storeRoadmap = Roadmap::create($validated);
        return $storeRoadmap ? response()->json([
            'status' => 200,
            'message' => 'uploaded',
            'data' => $storeRoadmap
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
        $getRoadmapBySlug = Roadmap::where('slug', $slug)->first()->load('tutorials');

        return $getRoadmapBySlug ? response()->json([
            'status' => 200,
            'message' => 'succes',
            'data' => $getRoadmapBySlug
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
    public function update(UpdatePostRequest $request, $id)
    {
        $validated = $request->validated();
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('image_roadmap');
        }

        $getRoadmap = Roadmap::where('slug', $id)->first();

        $updateRoadmap = $getRoadmap ? $getRoadmap->update($validated) : false;

        return $getRoadmap == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($updateRoadmap ? response()->json([
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
    public function destroy($slug)
    {
        $getDataRoadmap = Roadmap::where('slug', $slug)->first();
        $destroyRoadmap = $getDataRoadmap ? $getDataRoadmap->delete() : false;
        
        return $getDataRoadmap == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($destroyRoadmap ? response()->json([
            'status' => 200,
            'message' => 'success'
        ], 200) : response()->json([
            'status' => 400,
            'message' => 'failed'
        ], 400));
    }
}
