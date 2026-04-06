<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialIconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialIcons = SocialIcon::all();
        return response()->json([
            'status' => 200,
            'data' => $socialIcons
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
            'icon' => 'required|max:255|unique:social_icons,icon',
            'url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $socialIcon = new SocialIcon();
        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();

        return response()->json([
            'status' => 200,
            'message' => 'Created Successfully'
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $socialIcon = SocialIcon::find($id);

        if ($socialIcon == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Social Icon Not Found!'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $socialIcon
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
        $socialIcon = SocialIcon::find($id);

        if ($socialIcon == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Social Icon Not Found!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'icon' => 'required|max:255|unique:social_icons,icon,' . $id,
            'url' => 'required|url|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialIcon = SocialIcon::find($id);

        if ($socialIcon == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Social Icon Not Found!'
            ], 404);
        }

        $socialIcon->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully'
        ], 200);
    }
}
