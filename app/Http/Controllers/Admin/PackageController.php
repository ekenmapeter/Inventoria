<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest()->paginate(20);
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:subscription,fundraise',
            'is_active' => 'boolean',
        ]);

        if ($request->type === 'subscription') {
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'min_amount' => 'nullable|numeric|min:0',
                'max_amount' => 'nullable|numeric|min:0',
            ]);
        } elseif ($request->type === 'fundraise') {
            $request->validate([
                'amount' => 'nullable|numeric|min:0',
                'min_amount' => 'required|numeric|min:0',
                'max_amount' => 'required|numeric|min:0|gte:min_amount',
            ]);
        }

        Package::create($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:subscription,fundraise',
            'is_active' => 'boolean',
        ]);

        if ($request->type === 'subscription') {
            $request->validate([
                'amount' => 'required|numeric|min:0',
                'min_amount' => 'nullable|numeric|min:0',
                'max_amount' => 'nullable|numeric|min:0',
            ]);
        } elseif ($request->type === 'fundraise') {
            $request->validate([
                'amount' => 'nullable|numeric|min:0',
                'min_amount' => 'required|numeric|min:0',
                'max_amount' => 'required|numeric|min:0|gte:min_amount',
            ]);
        }

        $package->update($request->all());

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
