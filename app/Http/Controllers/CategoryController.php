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

    public function clientIndex(Request $request)
    {
        $q = $request->string('q')->toString();

        $categories = Category::query()
            ->select('id', 'name', 'description', 'image')
            ->withCount('foods')
            ->when($q, fn($qb) => $qb->where('name', 'like', "%{$q}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString()
            ->through(function ($c) {
                return $c;
            });

        return view('client.categories.index', compact('categories'));
    }
    public function clientShow(Category $category, Request $request)
    {
        $foods = $category->foods()
            ->select('id', 'name', 'price', 'image', 'category_id', 'quantity')
            ->latest()
            ->paginate(12)
            ->withQueryString()
            ->through(function ($f) {
                return $f;
            });

        return view('client.categories.show', compact('category', 'foods'));
    }
}
