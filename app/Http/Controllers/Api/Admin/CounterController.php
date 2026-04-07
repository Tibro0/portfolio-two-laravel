<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::all();
        return response()->json([
            'status' => 200,
            'data' => $counters
        ], 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $counter = Counter::find($id);

        if ($counter == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Counter Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $counter
        ], 200);
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
    public function update(Request $request, string $id)
    {
        $counter = Counter::find($id);

        if ($counter == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Counter Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'icon' => 'required|max:255|unique:counters,icon,'.$id,
            'number' => 'required|integer|max:255',
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $counter->icon = $request->icon;
        $counter->number = $request->number;
        $counter->title = $request->title;
        $counter->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
