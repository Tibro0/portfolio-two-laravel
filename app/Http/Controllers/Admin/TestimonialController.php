<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Testimonial;
use Illuminate\Http\Request;
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
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('title','testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:png'],
            'name' => ['required', 'max:255'],
            'designation' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'ratting' => ['required', 'integer', 'max:255'],
        ]);

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

            return redirect()->route('admin.testimonial.index')->with('toast', [
                'type' => 'success',
                'message' => 'Created Successfully!'
            ]);
        }
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
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:png'],
            'name' => ['required', 'max:255'],
            'designation' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'ratting' => ['required', 'integer', 'max:255'],
        ]);

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

            return redirect()->route('admin.testimonial.index')->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        }else{
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->name = $request->name;
            $testimonial->designation = $request->designation;
            $testimonial->description = $request->description;
            $testimonial->ratting = $request->ratting;
            $testimonial->save();

            return redirect()->route('admin.testimonial.index')->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        unlink($testimonial->image);
        $testimonial->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function testimonialMainTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'testimonial_main_title' => ['required', 'max:255'],
            'testimonial_sub_title' => ['required', 'max:255'],
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
