<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = Counter::all();
        return view('admin.hero-section.counter.index', compact('counters'));
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
        $counter = Counter::findOrFail($id);
        return response(['status' => 'success', 'counter' =>  $counter]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon'=> ['required', 'max:255', 'unique:counters,icon,'. $id],
            'number'=> ['required', 'max:255', 'integer'],
            'title'=> ['required', 'max:255'],
        ]);

        $counter = Counter::findOrFail($id);
        $counter->icon = $request->icon;
        $counter->number = $request->number;
        $counter->title = $request->title;
        $counter->save();

        return response(['status' => 'success', 'message'=> 'Updated Successfully!', 'counter' =>  $counter]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
