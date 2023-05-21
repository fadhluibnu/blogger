<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTutorialRequest;
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
        $getAllTutorial = Tutorial::all();

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
    public function update(Request $request, $id)
    {
        //
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
