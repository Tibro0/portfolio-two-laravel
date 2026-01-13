<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialIcons = SocialIcon::all();
        return view('admin.hero-section.social-icon.index', compact('socialIcons'));
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
        $request->validate([
            'icon' => ['required', 'max:255', 'unique:social_icons,icon'],
            'url' => ['required', 'url', 'max:255']
        ]);

        $socialIcon = new SocialIcon();
        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();

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
    public function edit(string $id)
    {
        $socialIcon = SocialIcon::findOrFail($id);
        return response(['status' => 'success', 'socialIcon' => $socialIcon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'max:255', 'unique:social_icons,icon,' . $id],
            'url' => ['required', 'url', 'max:255']
        ]);

        $socialIcon = SocialIcon::findOrFail($id);
        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();

        return response(['status' => 'success', 'message' => 'Updated Successfully!', 'socialIcon' => $socialIcon]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SocialIcon::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
