<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{
    public function index()
    {
        $keys = ['about_main_title', 'about_sub_title'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $about = About::first();
        return view('admin.about-section.index', compact('title', 'about'));
    }

    public function aboutUpdate(Request $request)
    {
        $request->validate([
            'signature' => ['nullable', 'image', 'mimes:png'],
            'signature_description' => ['required', 'max:255'],
            'description' => ['required'],
        ]);
        if ($request->file('signature')) {
            $image = $request->file('signature');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(300, 73);
            $img->toPng()->save(base_path('public/uploads/signature/' . $name_gen));
            $save_url = 'uploads/signature/' . $name_gen;

            About::updateOrCreate(
                ['id' => 1],
                [
                    'signature' => $save_url,
                    'signature_description' => $request->signature_description,
                    'description' => $request->description,
                ]
            );

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        } else {
            About::updateOrCreate(
                ['id' => 1],
                [
                    'signature_description' => $request->signature_description,
                    'description' => $request->description,
                ]
            );

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        }
    }

    public function aboutMainTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'about_main_title' => ['required', 'max:255'],
            'about_sub_title' => ['required', 'max:255'],
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
