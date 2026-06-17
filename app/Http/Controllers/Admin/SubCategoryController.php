<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Validation\Rule;
class SubCategoryController extends Controller
{
    //
       public function index()
    {
        $subcategories = Subcategory::with('category')
            ->orderBy('subcatid', 'desc')
            ->paginate(10);
            
        $categories = Category::where('istatus', 1)
            ->orderBy('catname')
            ->get();
            
        return view('admin.category.subcatgory', compact('subcategories', 'categories'));
    }

    /**
     * Store a newly created subcategory.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'catid' => 'required|exists:categories,catid',
            'subcatname' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subcategories', 'subcatname')->where(function ($query) use ($request) {
                    return $query->where('catid', $request->catid);
                }),
            ],
            'istatus' => 'required|in:0,1',
        ], [
            'subcatname.unique' => 'This subcategory name already exists for the selected category.',
        ]);

        Subcategory::create($validated);

        return redirect()->back()
            ->with('success', 'Subcategory created successfully.');
    }

    /**
     * Update the specified subcategory.
     */
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'catid' => 'required|exists:categories,catid',
            'subcatname' => [
                'required',
                'string',
                'max:100',
                Rule::unique('subcategories', 'subcatname')
                    ->where(function ($query) use ($request) {
                        return $query->where('catid', $request->catid);
                    })
                    ->ignore($subcategory->subcatid, 'subcatid'),
            ],
            'istatus' => 'required|in:0,1',
        ], [
            'subcatname.unique' => 'This subcategory name already exists for the selected category.',
        ]);

        $subcategory->update($validated);

        return redirect()->back()
            ->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified subcategory.
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        
        // You might want to check if there are any products using this subcategory
        // before allowing deletion
        
        $subcategory->delete();

        return redirect()->back()
            ->with('success', 'Subcategory deleted successfully.');
    }
}
