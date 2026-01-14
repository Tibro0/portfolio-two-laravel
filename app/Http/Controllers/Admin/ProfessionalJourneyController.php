<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfessionalJourney;
use App\Models\SectionTitle;
use Illuminate\Http\Request;

class ProfessionalJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['professional_journey_title', 'professional_journey_description', 'resume_main_title', 'resume_sub_title'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $professionalJourneys = ProfessionalJourney::all();
        return view('admin.resume.professional-journey.index', compact('title', 'professionalJourneys'));
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
            'year' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'sub_title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        $professionalJourney = new ProfessionalJourney();
        $professionalJourney->year = $request->year;
        $professionalJourney->title = $request->title;
        $professionalJourney->sub_title = $request->sub_title;
        $professionalJourney->description = $request->description;
        $professionalJourney->save();

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
        $professionalJourney = ProfessionalJourney::findOrFail($id);
        return response(['status' => 'success', 'professionalJourney' => $professionalJourney]);
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

        $professionalJourney = ProfessionalJourney::findOrFail($id);
        $professionalJourney->year = $request->year;
        $professionalJourney->title = $request->title;
        $professionalJourney->sub_title = $request->sub_title;
        $professionalJourney->description = $request->description;
        $professionalJourney->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProfessionalJourney::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function professionalJourneyTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'professional_journey_title' => ['required', 'max:255'],
            'professional_journey_description' => ['required', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response(['status' => 'success', 'message' => 'Update Successfully!']);
    }

    public function resumeMainTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'resume_main_title' => ['required', 'max:255'],
            'resume_sub_title' => ['required', 'max:255'],
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
