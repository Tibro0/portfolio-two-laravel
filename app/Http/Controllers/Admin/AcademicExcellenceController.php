<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicExcellence;
use App\Models\SectionTitle;
use Illuminate\Http\Request;

class AcademicExcellenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['academic_excellences_title', 'academic_excellences_description'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $academicExcellences = AcademicExcellence::all();
        return view('admin.resume.academic-excellence.index', compact('title', 'academicExcellences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resume.academic-excellence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'sub_title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        $academicExcellence = new AcademicExcellence();
        $academicExcellence->year = $request->year;
        $academicExcellence->title = $request->title;
        $academicExcellence->sub_title = $request->sub_title;
        $academicExcellence->description = $request->description;
        $academicExcellence->save();

        return redirect()->route('admin.academic-excellence.index')->with('toast', [
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
        $academicExcellence = AcademicExcellence::findOrFail($id);
        return view('admin.resume.academic-excellence.edit', compact('academicExcellence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'year' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'sub_title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        $academicExcellence = AcademicExcellence::findOrFail($id);
        $academicExcellence->year = $request->year;
        $academicExcellence->title = $request->title;
        $academicExcellence->sub_title = $request->sub_title;
        $academicExcellence->description = $request->description;
        $academicExcellence->save();

        return redirect()->route('admin.academic-excellence.index')->with('toast', [
            'type' => 'success',
            'message' => 'Update Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AcademicExcellence::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function academicExcellencesTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'academic_excellences_title' => ['required', 'max:255'],
            'academic_excellences_description' => ['required', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response(['status' => 'success', 'message' => 'Update Successfully!']);
    }
}
