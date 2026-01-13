<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CloudSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;

class CloudSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cloudSkills = CloudSkill::all();
        $skillCardTitleOne = SkillCardTitle::where('id', 4)->first();
        return view('admin.skill.cloud.index', compact('cloudSkills', 'skillCardTitleOne'));
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
            'title' => ['required', 'max:255', 'unique:cloud_skills,title'],
            'percentage' => ['required', 'integer', 'max:255'],
        ]);

        $cloudSkill = new CloudSkill();
        $cloudSkill->title = $request->title;
        $cloudSkill->percentage = $request->percentage;
        $cloudSkill->save();

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
        $cloudSkill = CloudSkill::findOrFail($id);
        return response(['status' => 'success', 'cloudSkill' => $cloudSkill]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'unique:cloud_skills,title,' . $id],
            'percentage' => ['required', 'integer', 'max:255'],
        ]);

        $cloudSkill = CloudSkill::findOrFail($id);
        $cloudSkill->title = $request->title;
        $cloudSkill->percentage = $request->percentage;
        $cloudSkill->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CloudSkill::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function cloudSkillCardTitleUpdate(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'max:255'],
            'title' => ['required', 'max:255']
        ]);

        $skillCardTitleOne = SkillCardTitle::findOrFail($id);
        $skillCardTitleOne->icon = $request->icon;
        $skillCardTitleOne->title = $request->title;
        $skillCardTitleOne->save();

        return response(['status' => 'success', 'message' => 'Update Successfully!', 'skillCardTitleOne' => $skillCardTitleOne->icon]);
    }
}
