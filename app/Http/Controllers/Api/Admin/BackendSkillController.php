<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackendSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BackendSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backendSkills = BackendSkill::all();
        $backendSkillCardTitle = SkillCardTitle::where('id', 2)->first();
        return response()->json([
            'status' => 200,
            'data' => [
                'backendSkills' => $backendSkills,
                'backendSkillCardTitle' => $backendSkillCardTitle,
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
            'title' => 'required|max:255|unique:backend_skills,title',
            'percentage' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $backendSkill = new BackendSkill();
        $backendSkill->title = $request->title;
        $backendSkill->percentage = $request->percentage;
        $backendSkill->save();

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
        $backendSkill = BackendSkill::find($id);

        if ($backendSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Backend Skill Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $backendSkill
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
        $backendSkill = BackendSkill::find($id);

        if ($backendSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Backend Skill Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:backend_skills,title,' . $id,
            'percentage' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $backendSkill->title = $request->title;
        $backendSkill->percentage = $request->percentage;
        $backendSkill->save();

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
        $backendSkill = BackendSkill::find($id);

        if ($backendSkill == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Backend Skill Not Found!',
            ], 404);
        }

        $backendSkill->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function backendSkillCardTitleUpdate(Request $request)
    {
        $skillCardTitleOne = SkillCardTitle::find(2);

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
