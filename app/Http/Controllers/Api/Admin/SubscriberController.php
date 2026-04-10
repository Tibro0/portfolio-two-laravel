<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\AllApiCredentialController;
use App\Mail\SubscriberMail;
use App\Models\SectionTitle;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['contact_main_title', 'contact_sub_title'];
        $subscriberTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $subscribers = Subscriber::where('status', 1)->get();
        return response()->json([
            'status' => 200,
            'data' => [
                'subscriberTitle' => $subscriberTitle,
                'subscribers' => $subscribers
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
            'email' => 'required|email|max:255|unique:subscribers,email',
            'address' => 'nullable|max:255',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->status = $request->status;
        $subscriber->save();

        return response()->json([
            'status' => 200,
            'message' => 'Created Successfully!',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscriber = Subscriber::find($id);

        if ($subscriber == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Subscriber Not Found!'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $subscriber
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
        $subscriber = Subscriber::find($id);

        if ($subscriber == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Subscriber Not Found!'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:subscribers,email,' . $id,
            'address' => 'nullable|max:255',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $subscriber->email = $request->email;
        $subscriber->address = $request->address;
        $subscriber->status = $request->status;
        $subscriber->save();

        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function subscriberBlock()
    {
        $subscribers = Subscriber::where('status', 0)->get();

        return response()->json([
            'status' => 200,
            'data' => $subscribers
        ], 200);
    }

    public function subscriberSent(Request $request)
    {
        AllApiCredentialController::emailApiSetting();

        $validator = Validator::make($request->all(), [
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 400);
        }

        $subscribers = Subscriber::where('status', 1)->pluck('email')->toArray();

        Mail::to($subscribers)->send(new SubscriberMail($request->subject, $request->message));

        return response()->json([
            'status' => 200,
            'message' => 'News letter Sent Successfully!'
        ], 200);
    }

    public function contactMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_main_title' => 'required|max:255',
            'contact_sub_title' => 'required|max:255'
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
