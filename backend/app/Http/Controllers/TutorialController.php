<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTutorialRequest;
use App\Http\Requests\UpdateTutorialRequest;
use App\Http\Resources\TutorialResource;
use App\Models\Roadmap;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Tutorial::all();
        $getAllTutorial = TutorialResource::collection(Tutorial::all()->load('dataTutorial'));
        return response()->json([
            'status' => 200,
            'data' => $getAllTutorial->isEmpty() ? null : $getAllTutorial
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTutorialRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('image_tutorial');

        $storeTutorial = Tutorial::create($validated);
        
        return $storeTutorial ? response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $storeTutorial
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
        $getTutorialBySlug = new TutorialResource(Tutorial::where('slug', $slug)->first()->load('dataTutorial'));

        return $getTutorialBySlug ? response()->json([
            'status' => 200,
            'message' => 'succes',
            'data' => $getTutorialBySlug
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
    public function update(UpdateTutorialRequest $request, $slug)
    {
        // return $request->all();
        $validated = $request->validated();
        $request->file('image') ? $validated['image'] = $request->file('image')->store('image_roadmap') : false;

        $getTutorial = Tutorial::where('slug', $slug)->first();

        $updateTutorial = $getTutorial ? $getTutorial->update($validated) : false;

        return $getTutorial == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($updateTutorial ? response()->json([
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
        $getTutorial = Tutorial::where('slug', $slug)->first();
        $destroyTutorial = $getTutorial ? $getTutorial->delete() : false;
        
        return $getTutorial == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($destroyTutorial ? response()->json([
            'status' => 200,
            'message' => 'success'
        ], 200) : response()->json([
            'status' => 400,
            'message' => 'failed'
        ], 400));
    }
}
