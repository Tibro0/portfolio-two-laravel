<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimationText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimationTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animationTexts = AnimationText::all();
        return response()->json([
            'status' => 200,
            'data' => $animationTexts
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:animation_texts,title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $animationText = new AnimationText();
        $animationText->title = $request->title;
        $animationText->save();

        return response()->json([
            'status' => 200,
            'message' => 'Created Successfully!',
            'data' => $animationText,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animationText = AnimationText::find($id);

        if ($animationText == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Animation Text Not Found!'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $animationText
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
        $animationText = AnimationText::find($id);

        if ($animationText == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Animation Text Not Found!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:animation_texts,title,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $animationText->title = $request->title;
        $animationText->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
            'data' => $animationText,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $animationText = AnimationText::find($id);

        if ($animationText == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Animation Text Not Found!',
            ], 404);
        }

        $animationText->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }
}
