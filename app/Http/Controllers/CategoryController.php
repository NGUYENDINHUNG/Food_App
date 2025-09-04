<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {

            $path = Storage::disk('s3')->put('categories', $request->file('image'));
        }
    
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
        ]);
        return redirect()->route('categories.index')->with('success', 'taọ danh mục thành công');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $category = Category::find($id);
        $path = $category->image; // mặc định giữ ảnh cũ

        if ($request->hasFile('image')) {
            // nếu có ảnh cũ thì xoá trên S3
            if ($category->image) {
                Storage::disk('s3')->delete($category->image);
            }

            // upload ảnh mới
            $path = Storage::disk('s3')->put('categories', $request->file('image'));
        }

        // cập nhật dữ liệu
        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Cập nhật danh mục thành công');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->image) {
            Storage::disk('s3')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công');
    }
}
