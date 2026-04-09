<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicExcellence;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcademicExcellenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['academic_excellences_title', 'academic_excellences_description'];
        $academicExcellenceTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $academicExcellences = AcademicExcellence::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'academicExcellenceTitle' => $academicExcellenceTitle,
                'academicExcellences' => $academicExcellences
            ]
        ]);
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

        $academicExcellence = new AcademicExcellence();
        $academicExcellence->year = $request->year;
        $academicExcellence->title = $request->title;
        $academicExcellence->sub_title = $request->sub_title;
        $academicExcellence->description = $request->description;
        $academicExcellence->save();

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
        $academicExcellence = AcademicExcellence::find($id);

        if ($academicExcellence == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Academic Excellence Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $academicExcellence
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
        $academicExcellence = AcademicExcellence::find($id);

        if ($academicExcellence == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Academic Excellence Not Found!',
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

        $academicExcellence->year = $request->year;
        $academicExcellence->title = $request->title;
        $academicExcellence->sub_title = $request->sub_title;
        $academicExcellence->description = $request->description;
        $academicExcellence->save();

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
        $academicExcellence = AcademicExcellence::find($id);

        if ($academicExcellence == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Academic Excellence Not Found!',
            ], 404);
        }

        $academicExcellence->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function academicExcellenceTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'academic_excellences_title' => 'required|max:255',
            'academic_excellences_description' => 'required|max:255',
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
            'message' => 'Update Successfully!'
        ], 200);
    }
}
