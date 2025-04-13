@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Menu Management</h2>
                        <p class="mt-1 text-sm text-gray-600">Manage your restaurant's menu items</p>
                    </div>
                    <a href="{{ route('admin.menu.create') }}" class="bg-[#C8A97E] text-white px-4 py-2 rounded-md hover:bg-[#B69A71] transition-colors">
                        Add New Menu Item
                    </a>
                </div>

                <!-- Menu Items Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Availability</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($menuItems as $menuItem)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $menuItem->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($menuItem->category)
                                        {{ $menuItem->category->name }}
                                        @else
                                        -
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">৳{{ number_format($menuItem->price, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($menuItem->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                        {{ $menuItem->is_available ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.menu.edit', ['menuItem' => $menuItem->id]) }}" class="text-[#C8A97E] hover:text-[#B69A71]">Edit</a>
                                        <form action="{{ route('admin.menu.destroy', ['menuItem' => $menuItem->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No menu items found. Click "Add New Menu Item" to create one.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($menuItems->hasPages())
                <div class="mt-4">
                    {{ $menuItems->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection