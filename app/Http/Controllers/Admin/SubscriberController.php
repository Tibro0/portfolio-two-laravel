<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SubscriberMail;
use App\Models\SectionTitle;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['contact_main_title', 'contact_sub_title'];
        $title = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $subscribers = Subscriber::where('status', 1)->get();
        return view('admin.subscriber.index', compact('title', 'subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriber.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email'],
            'address' => ['nullable', 'max:255']
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->status = $request->status;
        $subscriber->save();

        return redirect()->route('admin.subscriber.index')->with('toast', [
            'type' => 'success',
            'message' => 'Created Successfully!'
        ]);
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
        $subscriber = Subscriber::findOrFail($id);
        return view('admin.subscriber.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email,' . $id],
            'address' => ['nullable', 'max:255']
        ]);

        $subscriber = Subscriber::findOrFail($id);
        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->status = $request->status;
        $subscriber->save();

        return redirect()->route('admin.subscriber.index')->with('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subscriber::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function subscriberBlock()
    {
        $subscribers = Subscriber::where('status', 0)->get();
        return view('admin.subscriber.block', compact('subscribers'));
    }

    public function subscriberSent(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'message' => ['required']
        ]);

        $subscribers = Subscriber::where('status', 1)->pluck('email')->toArray();

        Mail::to($subscribers)->send(new SubscriberMail($request->subject, $request->message));

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'News letter Sent Successfully!'
        ]);
    }

    public function contactMainTitleUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'contact_main_title' => ['required', 'max:255'],
            'contact_sub_title' => ['required', 'max:255'],
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
