<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimationText;
use Illuminate\Http\Request;

class AnimationTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animationTexts = AnimationText::all();
        return view('admin.hero-section.animation-text.index', compact('animationTexts'));
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
        $request->validate([
            'title' => ['required', 'max:255', 'unique:animation_texts,title']
        ]);

        $animationText = new AnimationText();
        $animationText->title = $request->title;
        $animationText->save();

        return response(['status' => 'success', 'message' => 'Created Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $animationText = AnimationText::findOrFail($id);

        return response(['status' => 'success', 'animationText' => $animationText]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'unique:animation_texts,title,' . $request->id]
        ]);

        $animationText = AnimationText::findOrFail($request->id);
        $animationText->title = $request->title;
        $animationText->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AnimationText::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
