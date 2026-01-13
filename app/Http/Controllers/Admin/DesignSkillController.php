<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;

class DesignSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designSkills = DesignSkill::all();
        $skillCardTitleOne = SkillCardTitle::where('id', 3)->first();
        return view('admin.skill.design.index', compact('designSkills','skillCardTitleOne'));
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
            'title'=>['required', 'max:255', 'unique:design_skills,title'],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $designSkill = new DesignSkill();
        $designSkill->title = $request->title;
        $designSkill->percentage = $request->percentage;
        $designSkill->save();

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
        $designSkill = DesignSkill::findOrFail($id);
        return response(['status' => 'success', 'designSkill' => $designSkill]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>['required', 'max:255', 'unique:design_skills,title,'.$id],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $designSkill = DesignSkill::findOrFail($id);
        $designSkill->title = $request->title;
        $designSkill->percentage = $request->percentage;
        $designSkill->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DesignSkill::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function designSkillCardTitleUpdate(Request $request, string $id)
    {
        $request->validate([
            'icon'=> ['required', 'max:255'],
            'title'=>['required', 'max:255']
        ]);

        $skillCardTitleOne = SkillCardTitle::findOrFail($id);
        $skillCardTitleOne->icon = $request->icon;
        $skillCardTitleOne->title = $request->title;
        $skillCardTitleOne->save();

        return response(['status' => 'success', 'message' => 'Update Successfully!', 'skillCardTitleOne' => $skillCardTitleOne->icon]);
    }
}
