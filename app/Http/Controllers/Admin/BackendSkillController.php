<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackendSkill;
use App\Models\SkillCardTitle;
use Illuminate\Http\Request;

class BackendSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backendSkills = BackendSkill::all();
        $skillCardTitleOne = SkillCardTitle::where('id', 2)->first();
        return view('admin.skill.backend.index', compact('backendSkills','skillCardTitleOne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skill.backend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required', 'max:255', 'unique:backend_skills,title'],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $backendSkill = new BackendSkill();
        $backendSkill->title = $request->title;
        $backendSkill->percentage = $request->percentage;
        $backendSkill->save();

        return redirect()->route('admin.backend-skill.index')->with('toast', [
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
        $backendSkill = BackendSkill::findOrFail($id);
        return view('admin.skill.backend.edit', compact('backendSkill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>['required', 'max:255', 'unique:backend_skills,title,'.$id],
            'percentage'=>['required', 'integer', 'max:255'],
        ]);

        $backendSkill = BackendSkill::findOrFail($id);
        $backendSkill->title = $request->title;
        $backendSkill->percentage = $request->percentage;
        $backendSkill->save();

        return redirect()->route('admin.backend-skill.index')->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BackendSkill::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function backendSkillCardTitleUpdate(Request $request, string $id)
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
