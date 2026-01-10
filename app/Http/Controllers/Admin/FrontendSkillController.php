<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;

class FrontendSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frontendSkills = FrontendSkill::all();
        $skillCardTitleOne = SkillCardTitle::where('id', 1)->first();
        return view('admin.skill.frontend.index', compact('frontendSkills','skillCardTitleOne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skill.frontend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required', 'max:255', 'unique:frontend_skills,title'],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $frontendSkill = new FrontendSkill();
        $frontendSkill->title = $request->title;
        $frontendSkill->percentage = $request->percentage;
        $frontendSkill->save();

        return redirect()->route('admin.frontend-skill.index')->with('toast', [
            'type' => 'success',
            'message' => 'Created Successfully!'
        ]);
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
        $frontendSkill = FrontendSkill::findOrFail($id);
        return view('admin.skill.frontend.edit', compact('frontendSkill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>['required', 'max:255', 'unique:frontend_skills,title,'.$id],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $frontendSkill = FrontendSkill::findOrFail($id);
        $frontendSkill->title = $request->title;
        $frontendSkill->percentage = $request->percentage;
        $frontendSkill->save();

        return redirect()->route('admin.frontend-skill.index')->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FrontendSkill::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function skillCardTitleUpdate(Request $request, string $id)
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
