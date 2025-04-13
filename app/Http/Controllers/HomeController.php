<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function menu()
    {
        // Get all categories with their available menu items
        $categories = Category::with(['menuItems' => function ($query) {
            $query->where('is_available', true);
        }])->get();

        // Transform the data into the required format
        $menuItems = $categories->mapWithKeys(function ($category) {
            return [$category->name => $category->menuItems->map(function ($item) {
                return [
                    'name' => $item->name,
                    'description' => $item->description,
                    'price' => $item->price,
                    'image' => $item->image_url ?? 'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg'
                ];
            })];
        })->filter(function ($items) {
            return $items->isNotEmpty();
        });

        return view('pages.menu', compact('menuItems'));
    }

    public function events()
    {
        return view('pages.events');
    }

    public function story()
    {
        return view('pages.story');
    }

    public function reservations()
    {
        return view('pages.reservation');
    }
}
