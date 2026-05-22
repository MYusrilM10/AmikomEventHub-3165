<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ - Display all categories
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $categories = $query->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    // CREATE - Show form for creating new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE - Save new category to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'popularity' => 'required|in:Trending,Popular,New',
            'created_at' => 'required|date_format:Y-m-d',
        ]);

        Category::create([
            'name' => $validated['name'],
            'popularity' => $validated['popularity'],
            'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d', $validated['created_at'])->startOfDay(),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // EDIT - Show form for editing category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE - Update category in database
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'popularity' => 'required|in:Trending,Popular,New',
            'created_at' => 'required|date_format:Y-m-d',
        ]);

        $category->update([
            'name' => $validated['name'],
            'popularity' => $validated['popularity'],
            'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d', $validated['created_at'])->startOfDay(),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // DELETE - Remove category from database
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
