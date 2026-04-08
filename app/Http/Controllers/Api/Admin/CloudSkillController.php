<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloudSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CloudSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cloudSkills = CloudSkill::all();
        $cloudSkillCardTitle = SkillCardTitle::where('id', 4)->first();
        return response()->json([
            'status' => 200,
            'data' => [
                'cloudSkills' => $cloudSkills,
                'cloudSkillCardTitle' => $cloudSkillCardTitle,
            ]
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
            'title' => 'required|max:255|unique:cloud_skills,title',
            'percentage' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $cloudSkill = new CloudSkill();
        $cloudSkill->title = $request->title;
        $cloudSkill->percentage = $request->percentage;
        $cloudSkill->save();

        return response()->json([
            'status' => 200,
            'message' => 'Created Successfully!',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cloudSkill = CloudSkill::find($id);

        if ($cloudSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Cloud Skill Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $cloudSkill
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
        $cloudSkill = CloudSkill::find($id);

        if ($cloudSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Cloud Skill Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:cloud_skills,title,' . $id,
            'percentage' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $cloudSkill->title = $request->title;
        $cloudSkill->percentage = $request->percentage;
        $cloudSkill->save();

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
        $cloudSkill = CloudSkill::find($id);

        if ($cloudSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Cloud Skill Not Found!',
            ], 404);
        }

        $cloudSkill->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

     public function cloudSkillCardTitleUpdate(Request $request)
    {
        $skillCardTitleOne = SkillCardTitle::find(4);

        $validator = Validator::make($request->all(), [
            'icon' => 'required|max:255',
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $skillCardTitleOne->icon = $request->icon;
        $skillCardTitleOne->title = $request->title;
        $skillCardTitleOne->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
        ], 200);
    }
}
