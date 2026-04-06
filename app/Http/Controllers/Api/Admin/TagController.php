<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'status' => 200,
            'data' => $tags
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
        $tag = Tag::find($id);

        if ($tag == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Tag Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $tag
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
        $tag = Tag::find($id);

        if ($tag == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Tag Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'icon' => 'required|max:255|unique:tags,icon,' . $id,
            'name' => 'required|max:255|unique:tags,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $tag->icon = $request->icon;
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'status' => 200,
            'message' => 'Tag Updated Successfully!',
            'data' => $tag
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
