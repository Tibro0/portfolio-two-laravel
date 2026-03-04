<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'avatar' => ['image', 'nullable', 'mimes:png',],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'phone_one' => ['required', 'max:255'],
            'phone_two' => ['nullable', 'max:255'],
            'address_line_one' => ['required', 'max:255'],
            'address_line_two' => ['nullable', 'max:255'],
            'short_description' => ['required', 'max:255']
        ]);

        $oldImage = $request->old_avatar;
        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1024, 1024);
            $img->toPng()->save(base_path('public/uploads/avatar/' . $name_gen));
            $save_url = 'uploads/avatar/' . $name_gen;

            $user = Auth::user();
            $user->avatar = $save_url;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_one = $request->phone_one;
            $user->phone_two = $request->phone_two;
            $user->address_line_one = $request->address_line_one;
            $user->address_line_two = $request->address_line_two;
            $user->short_description = $request->short_description;
            $user->save();

            $defaultImages = [
                'uploads/avatar.png',
            ];

            if ($oldImage && !in_array($oldImage, $defaultImages) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        } else {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_one = $request->phone_one;
            $user->phone_two = $request->phone_two;
            $user->address_line_one = $request->address_line_one;
            $user->address_line_two = $request->address_line_two;
            $user->short_description = $request->short_description;
            $user->save();

            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:5', 'confirmed']
        ], [
            'current_password.current_password' => 'Current password is invalid.',
            'current_password.required' => 'Current password field is required.'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }
}
