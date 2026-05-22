<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('location', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $events = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Event::create($data);
        

        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil ditambahkan.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Data event berhasil dihapus secara permanen.');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Rincian Data event berhasil diperbarui.');
    }
}
