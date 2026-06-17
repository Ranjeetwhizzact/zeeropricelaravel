<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackagePoint;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    //
    
    /**
     * Display a listing of the points packages.
     */
    public function index()
    {
        $packages = PackagePoint::orderBy('id', 'desc')->paginate(10);
        return view('admin.package', compact('packages'));
    }

    /**
     * Store a newly created points package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'packagename' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pointspackage', 'packagename')
            ],
            'points' => 'required|integer|min:1',
            'currency' => 'required|string|max:10',
            'cost' => 'required|numeric|min:0',
            'istatus' => 'required|in:0,1',
        ], [
            'packagename.unique' => 'This package name already exists.',
            'points.min' => 'Points must be at least 1.',
            'cost.min' => 'Cost must be a positive number.',
        ]);

       PackagePoint::create($validated);

        return redirect()->back()
            ->with('success', 'Points package created successfully.');
    }

    /**
     * Update the specified points package.
     */
    public function update(Request $request, $id)
    {
        $package = PackagePoint::findOrFail($id);

        $validated = $request->validate([
            'packagename' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pointspackage', 'packagename')->ignore($id)
            ],
            'points' => 'required|integer|min:1',
            'currency' => 'required|string|max:10',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ], [
            'packagename.unique' => 'This package name already exists.',
            'points.min' => 'Points must be at least 1.',
            'cost.min' => 'Cost must be a positive number.',
        ]);

        $package->update($validated);

        return redirect()->back()
            ->with('success', 'Points package updated successfully.');
    }

    /**
     * Remove the specified points package.
     */
    public function destroy($id)
    {
        $package = PackagePoint::findOrFail($id);
        $package->delete();

        return redirect()->back()
            ->with('success', 'Points package deleted successfully.');
    }
}

