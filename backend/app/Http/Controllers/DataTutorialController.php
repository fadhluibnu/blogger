<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataTutorialRequest;
use App\Http\Requests\UpdateDataTutorialRequest;
use App\Models\DataTutorial;
use Illuminate\Http\Request;

class DataTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllDataTutorial = DataTutorial::all()->load('tutorials', 'post');

        return response()->json([
            'status' => 200,
            'data' => $getAllDataTutorial->isEmpty() ? null : $getAllDataTutorial
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
    public function store(StoreDataTutorialRequest $request)
    {
        $storeDataTutorial = DataTutorial::create($request->validated());
        
        return $storeDataTutorial ? response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $storeDataTutorial
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
    public function update(UpdateDataTutorialRequest $request, $id)
    {
        $validated = $request->validated();
        $getDataTutorial = DataTutorial::where('id', $id)->first();

        $updateDataTutorial = $getDataTutorial ? $getDataTutorial->update($validated) : false;

        return $getDataTutorial == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($updateDataTutorial ? response()->json([
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
        $getDataTutorial = DataTutorial::where('id', $id)->first();
        $destroyDataTutorial = $getDataTutorial ? $getDataTutorial->delete() : false;
        
        return $getDataTutorial == false ? response()->json([
            'status' => 404,
            'message' => 'not found'
        ], 404) : ($destroyDataTutorial ? response()->json([
            'status' => 200,
            'message' => 'success'
        ], 200) : response()->json([
            'status' => 400,
            'message' => 'failed'
        ], 400));
    }
}
