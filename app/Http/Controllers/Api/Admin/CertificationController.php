<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['professional_expertise_title', 'professional_expertise_description'];
        $certificationTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $certifications = Certification::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'certificationTitle' => $certificationTitle,
                'certifications' => $certifications
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
            'title' => 'required|max:255|unique:certifications,title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $certification = new Certification();
        $certification->title = $request->title;
        $certification->save();

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
        $certification = Certification::find($id);

        if ($certification == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Certification Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $certification
        ]);
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
        $certification = Certification::find($id);

        if ($certification == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Certification Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:certifications,title,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $certification->title = $request->title;
        $certification->save();

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
        $certification = Certification::find($id);

        if ($certification == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Certification Not Found!',
            ], 404);
        }

        $certification->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function professionalExpertiseTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professional_expertise_title' => 'required|max:255',
            'professional_expertise_description' => 'required|max:255',
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
