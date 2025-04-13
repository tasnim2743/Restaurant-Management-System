<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = [
            'Main Course' => 'Hearty and fulfilling main dishes',
            'Appetizers' => 'Start your meal with our delicious appetizers',
            'Desserts' => 'Sweet treats to end your meal',
            'Drinks' => 'Refreshing beverages and drinks',
            'Salads' => 'Fresh and healthy salad options'
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'description' => $description
            ]);
        }

        // Create sample menu items with unique images
        $menuItems = [
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Classic Italian pasta with creamy sauce and pancetta',
                'price' => 15.99,
                'category_id' => 1, // Main Course
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/1527603/pexels-photo-1527603.jpeg'
            ],
            [
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon with herbs and lemon butter sauce',
                'price' => 24.99,
                'category_id' => 1, // Main Course
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/3763847/pexels-photo-3763847.jpeg'
            ],
            [
                'name' => 'Bruschetta',
                'description' => 'Toasted bread with fresh tomatoes, garlic, and basil',
                'price' => 8.99,
                'category_id' => 2, // Appetizers
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/2228539/pexels-photo-2228539.jpeg'
            ],
            [
                'name' => 'Caprese Salad',
                'description' => 'Fresh mozzarella, tomatoes, and basil with balsamic glaze',
                'price' => 10.99,
                'category_id' => 5, // Salads
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/2741457/pexels-photo-2741457.jpeg'
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Traditional Italian dessert with coffee and mascarpone',
                'price' => 7.99,
                'category_id' => 3, // Desserts
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/6880219/pexels-photo-6880219.jpeg'
            ],
            [
                'name' => 'Panna Cotta',
                'description' => 'Silky vanilla cream dessert with berry compote',
                'price' => 6.99,
                'category_id' => 3, // Desserts
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/6880211/pexels-photo-6880211.jpeg'
            ],
            [
                'name' => 'Italian Red Wine',
                'description' => 'Premium house red wine from Tuscany',
                'price' => 8.99,
                'category_id' => 4, // Drinks
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/2664150/pexels-photo-2664150.jpeg'
            ],
            [
                'name' => 'Mediterranean Salad',
                'description' => 'Mixed greens with feta, olives, and house dressing',
                'price' => 11.99,
                'category_id' => 5, // Salads
                'is_available' => true,
                'image_url' => 'https://images.pexels.com/photos/1213710/pexels-photo-1213710.jpeg'
            ]
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
