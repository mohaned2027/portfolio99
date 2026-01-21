<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'services' => Service::get(['id' , 'title', 'description', 'icon']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',

        ]);

        $service = Service::create($validated);

        return response()->json([
            'message' => 'Service created successfully',
            'service' => $service
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'icon'        => 'nullable|string|max:100',

        ]);

        $service->update($validated);

        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service
        ]);
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Service deleted successfully'
        ]);
    }
}
