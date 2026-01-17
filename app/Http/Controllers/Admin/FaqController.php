<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SectionTitle;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['faq_main_title', 'faq_sub_title'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $faqs = Faq::all();
        return view('admin.faq.index', compact('title', 'faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

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
    public function edit(string $id, Request $request)
    {
        $faq = Faq::findOrFail($id);
        return response(['status' => 'success', 'faq' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);

        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faq::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function faqMainTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'faq_main_title' => ['required', 'max:255'],
            'faq_sub_title' => ['required', 'max:255'],
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
