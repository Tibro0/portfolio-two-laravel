<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keys = ['services_main_title', 'services_sub_title'];
        $serviceTitle = SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
        $services = Service::all();
        return response()->json([
            'status' => 200,
            'data' => [
                'serviceTitle' => $serviceTitle,
                'services' => $services,
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
            'icon' => 'required|max:255',
            'title' => 'required|max:255|unique:services,title',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $service = new Service();
        $service->icon = $request->icon;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->save();

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
        $service = Service::find($id);

        if ($service == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Service Not Found!',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $service,
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
        $service = Service::find($id);

        if ($service == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Service Not Found!',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'icon' => 'required|max:255',
            'title' => 'required|max:255|unique:services,title,' . $id,
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ], 400);
        }

        $service->icon = $request->icon;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->save();

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
        $service = Service::find($id);

        if ($service == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Service Not Found!',
            ], 404);
        }

        $service->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully!',
        ], 200);
    }

    public function servicesMainTitleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services_main_title' => 'required|max:255',
            'services_sub_title' => 'required|max:255',
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
