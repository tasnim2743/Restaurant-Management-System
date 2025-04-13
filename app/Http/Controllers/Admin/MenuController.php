<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('admin.menu.index', compact('menuItems', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_url' => 'nullable|url'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu-items', 'public');
            $validated['image_url'] = asset('storage/' . $path);
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        }

        // Set default values for boolean fields
        $validated['is_available'] = $request->boolean('is_available');

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item created successfully');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_url' => 'nullable|url'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is a local file
            if ($menuItem->image_url && str_starts_with($menuItem->image_url, asset('storage'))) {
                $oldPath = str_replace(asset('storage/'), '', $menuItem->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('menu-items', 'public');
            $validated['image_url'] = asset('storage/' . $path);
        } elseif ($request->filled('image_url')) {
            $validated['image_url'] = $request->image_url;
        }

        // Set boolean fields
        $validated['is_available'] = $request->boolean('is_available');

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item updated successfully');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item deleted successfully');
    }
}
