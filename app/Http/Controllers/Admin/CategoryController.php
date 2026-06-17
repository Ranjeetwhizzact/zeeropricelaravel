<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::orderBy('catid', 'desc')->paginate(10);;
        return view('admin.category.index',compact('categories'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'catname' => 'required|string|max:100|unique:categories,catname',
            'istatus' => 'required|in:0,1'
        ]);

        Category::create([
            'catname' => $request->catname,
            'istatus' => $request->istatus
        ]);

        return redirect()->back()
            ->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('catid', $id)->firstOrFail();

        $request->validate([
            'catname' => 'required|string|max:100|unique:categories,catname,' . $id . ',catid',
            'istatus' => 'required|in:0,1'
        ]);

        $category->update([
            'catname' => $request->catname,
            'istatus' => $request->istatus
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::where('catid', $id)->firstOrFail();
        
        // Check if category has subcategories
        if ($category->subcategories()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete category with subcategories!');
        }

        $category->delete();

        return redirect()->back()
            ->with('success', 'Category deleted successfully!');
    }
    }
