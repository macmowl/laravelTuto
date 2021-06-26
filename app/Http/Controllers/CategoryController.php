<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function Allcategories() {
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCategory(Request $request) {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:40',
        ],[
            'category_name.required' => 'Fill with a category name'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Category successfully inserted');
    }

    public function edit ($id) {
        $category = Category::find($id);
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update (Request $request, $id) {
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);
        return Redirect()->route('all.categories')->with('success', 'Category successfully updated');
    }

    public function softDelete($id) {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category successfully deleted');
    }

    public function permanentDelete($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category permanently deleted');
    }

    public function restore($id) {
        $restored = Category::withTrashed()->find($id)->restore();
            return Redirect()->back()->with('success', 'Category successfully restored');
    }
}
