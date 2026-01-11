<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\SectionTitle;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['professional_expertise_title', 'professional_expertise_description'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $certifications = Certification::all();
        return view('admin.certification.index', compact('title','certifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['required', 'max:255', 'unique:certifications,title']
        ]);

        $certification = new Certification();
        $certification->title = $request->title;
        $certification->save();

        return redirect()->route('admin.certification.index')->with('toast', [
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
        $certification = Certification::findOrFail($id);
        return view('admin.certification.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=> ['required', 'max:255', 'unique:certifications,title,'.$id]
        ]);

        $certification = Certification::findOrFail($id);
        $certification->title = $request->title;
        $certification->save();

        return redirect()->route('admin.certification.index')->with('toast', [
            'type' => 'success',
            'message' => 'Update Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Certification::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function professionalExpertiseTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'professional_expertise_title' => ['required', 'max:255'],
            'professional_expertise_description' => ['required', 'max:255'],
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
