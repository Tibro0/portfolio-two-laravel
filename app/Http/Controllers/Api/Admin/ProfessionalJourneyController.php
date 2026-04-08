<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfessionalJourney;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionalJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['professional_journey_title', 'professional_journey_description', 'resume_main_title', 'resume_sub_title'];
        $professionalJourneyTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $professionalJourneys = ProfessionalJourney::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'professionalJourneyTitle' => $professionalJourneyTitle,
                'professionalJourneys' => $professionalJourneys
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
            'year' => 'required|max:255',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $professionalJourney = new ProfessionalJourney();
        $professionalJourney->year = $request->year;
        $professionalJourney->title = $request->title;
        $professionalJourney->sub_title = $request->sub_title;
        $professionalJourney->description = $request->description;
        $professionalJourney->save();

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
        $professionalJourney = ProfessionalJourney::find($id);

        if ($professionalJourney == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Professional Journey Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $professionalJourney
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
        $professionalJourney = ProfessionalJourney::find($id);

        if ($professionalJourney == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Professional Journey Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'year' => 'required|max:255',
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $professionalJourney->year = $request->year;
        $professionalJourney->title = $request->title;
        $professionalJourney->sub_title = $request->sub_title;
        $professionalJourney->description = $request->description;
        $professionalJourney->save();

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
        $professionalJourney = ProfessionalJourney::find($id);

        if ($professionalJourney == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Professional Journey Not Found!',
            ], 404);
        }

        $professionalJourney->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function professionalJourneyTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professional_journey_title' => 'required|max:255',
            'professional_journey_description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
        ], 200);
    }

    public function resumeMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resume_main_title' => 'required|max:255',
            'resume_sub_title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $validatedData = $validator->validated();

        foreach ($validatedData as $key => $value) {
            SectionTitle::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
        ], 200);
    }
}
