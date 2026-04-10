<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['faq_main_title', 'faq_sub_title'];
        $faqTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $faqs = Faq::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'faqTitle' => $faqTitle,
                'faqs' => $faqs
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
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json([
            'status' => 200,
            'message' => 'Created Successfully!'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::find($id);

        if ($faq == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Faq Not Found!'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $faq
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
        $faq = Faq::find($id);

        if ($faq == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Faq Not Found!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::find($id);

        if ($faq == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Faq Not Found!'
            ], 404);
        }

        $faq->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!'
        ], 200);
    }

    public function faqMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faq_main_title' => ['required', 'max:255'],
            'faq_sub_title' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
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
