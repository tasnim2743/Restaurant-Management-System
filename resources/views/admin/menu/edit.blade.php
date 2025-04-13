@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Menu Item</h1>

        <form action="{{ route('admin.menu.update', $menuItem) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $menuItem->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="category_id" id="category_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category_id') border-red-500 @enderror"
                    required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $menuItem->price) }}" step="0.01" min="0"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror"
                    required>
                @error('price')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $menuItem->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image Preview -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Current Image</label>
                @if($menuItem->image_url)
                <div class="mb-2">
                    <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}" class="w-32 h-32 object-cover rounded">
                </div>
                @else
                <p class="text-gray-600 text-sm">No image currently set</p>
                @endif
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Update Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
                <p class="text-gray-600 text-xs mt-1">Upload a new menu item image (JPEG, PNG, GIF up to 10MB)</p>
                @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL Alternative -->
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Or Image URL</label>
                <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $menuItem->image_url) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="https://example.com/image.jpg">
                <p class="text-gray-600 text-xs mt-1">Alternatively, provide a direct URL to the image</p>
            </div>

            <!-- Availability -->
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_available" class="form-checkbox" value="1"
                        {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}>
                    <span class="ml-2 text-gray-700 text-sm font-bold">Available</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-[#C8A97E] hover:bg-[#B69A71] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Menu Item
                </button>
                <a href="{{ route('admin.menu.index') }}"
                    class="text-gray-600 hover:text-gray-800 font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection