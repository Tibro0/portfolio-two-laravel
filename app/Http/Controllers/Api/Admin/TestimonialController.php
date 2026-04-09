<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['testimonial_main_title', 'testimonial_sub_title'];
        $testimonialTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $testimonials = Testimonial::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'testimonialTitle' => $testimonialTitle,
                'testimonials' => $testimonials,
            ],
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
            'image' => 'required|image|mimes:png',
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'ratting' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1024, 1024);
            $img->toPng()->save(base_path('public/uploads/testimonial/' . $name_gen));
            $save_url = 'uploads/testimonial/' . $name_gen;

            $testimonial = new Testimonial();
            $testimonial->image = $save_url;
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->description = $request->description;
            $testimonial->ratting = $request->ratting;
            $testimonial->save();

            return response()->json([
                'status' => 200,
                'message' => 'Created Successfully!',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::find($id);

        if ($testimonial == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Testimonial Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $testimonial,
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
        $testimonial = Testimonial::find($id);

        if ($testimonial == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Testimonial Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:png',
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'ratting' => 'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $oldImage = $testimonial->image;
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1024, 1024);
            $img->toPng()->save(base_path('public/uploads/testimonial/' . $name_gen));
            $save_url = 'uploads/testimonial/' . $name_gen;

            $testimonial = Testimonial::findOrFail($id);
            $testimonial->image = $save_url;
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->description = $request->description;
            $testimonial->ratting = $request->ratting;
            $testimonial->save();

            $defaultImages = [
                'frontend/assets/img/person/person-f-1.webp',
                'frontend/assets/img/person/person-m-2.webp',
                'frontend/assets/img/person/person-f-3.webp',
                'frontend/assets/img/person/person-m-4.webp',
            ];

            if ($oldImage && !in_array($oldImage, $defaultImages) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Updated Successfully!',
            ], 200);
        } else {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->description = $request->description;
            $testimonial->ratting = $request->ratting;
            $testimonial->save();

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
        $testimonial = Testimonial::find($id);

        if ($testimonial == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Testimonial not found',
            ], 404);
        }

        $defaultImages = [
            'frontend/assets/img/person/person-f-1.webp',
            'frontend/assets/img/person/person-m-2.webp',
            'frontend/assets/img/person/person-f-3.webp',
            'frontend/assets/img/person/person-m-4.webp',
        ];

        if ($testimonial->image && !in_array($testimonial->image, $defaultImages) && file_exists($testimonial->image)) {
            unlink($testimonial->image);
        }

        $testimonial->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function testimonialMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_main_title' => ['required', 'max:255'],
            'testimonial_sub_title' => ['required', 'max:255'],
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
            'message' => 'Update Successfully!',
        ], 200);
    }
}
