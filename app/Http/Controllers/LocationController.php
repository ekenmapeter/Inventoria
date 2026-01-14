<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        try {
            $locations = Location::all();
            return response()->json($locations);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch locations',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|in:warehouse,store,shop',
                'address' => 'nullable|string'
            ]);

            $location = Location::create($validated);
            return response()->json($location, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create location',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $location = Location::findOrFail($id);
            return response()->json($location);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch location',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $location = Location::findOrFail($id);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|in:warehouse,store,shop',
                'address' => 'nullable|string'
            ]);

            $location->update($validated);
            return response()->json($location);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update location',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $location = Location::findOrFail($id);
            $location->delete();
            return response()->json(['message' => 'Location deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete location',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
