<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['about_main_title', 'about_sub_title'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $about = About::first();

        return response()->json([
            'status' => 200,
            'data' => [
                'title' => $title,
                'about' => $about,
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signature' => 'nullable|image|mimes:png',
            'signature_description' => 'nullable|max:255',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $oldImage = About::where('id', 1)->value('signature');

        if ($request->file('signature')) {
            $image = $request->file('signature');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(300, 73);
            $img->toPng()->save(base_path('public/uploads/signature/' . $name_gen));
            $save_url = 'uploads/signature/' . $name_gen;

            $defaultImages = [
                'frontend/assets/img/misc/signature-1.webp',
            ];

            if ($oldImage && !in_array($oldImage, $defaultImages) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            About::updateOrCreate(
                ['id' => 1],
                [
                    'signature' => $save_url,
                    'signature_description' => $request->signature_description,
                    'description' => $request->description,
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Updated Successfully!',
            ], 200);
        } else {
            About::updateOrCreate(
                ['id' => 1],
                [
                    'signature_description' => $request->signature_description,
                    'description' => $request->description,
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Updated Successfully!',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function aboutMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_main_title' => 'required|max:255',
            'about_sub_title' => 'required|max:255',
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
