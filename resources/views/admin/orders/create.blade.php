@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Create New Order</h2>
                </div>

                <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
                    @csrf
                    <div class="space-y-6">
                        <!-- Table Selection -->
                        <div>
                            <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                            <select name="table_id" id="table_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]">
                                <option value="">Select a table</option>
                                @foreach($tables as $table)
                                <option value="{{ $table->id }}">
                                    Table #{{ $table->table_number }} ({{ $table->capacity }} seats)
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Menu Items -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Menu Items</h3>
                            <div id="menuItems" class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <select name="items[0][menu_item_id]" required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]">
                                        <option value="">Select an item</option>
                                        @foreach($menuItems as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }} - ${{ number_format($item->price, 2) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="items[0][quantity]" min="1" value="1" required
                                        class="block w-24 rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]">
                                    <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">Remove</button>
                                </div>
                            </div>
                            <button type="button" onclick="addMenuItem()"
                                class="mt-4 text-sm text-[#C8A97E] hover:text-[#B69A71]">
                                + Add Another Item
                            </button>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                                placeholder="Any special instructions or notes..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-[#C8A97E] text-white px-4 py-2 rounded-md hover:bg-[#B69A71] transition-colors">
                                Create Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let itemCount = 1;
    const menuItemTemplate = document.querySelector('#menuItems .flex').cloneNode(true);
    
    function addMenuItem() {
        const menuItems = document.getElementById('menuItems');
        const newItem = menuItemTemplate.cloneNode(true);
        
        // Update the name attributes with the new index
        newItem.querySelector('select').name = `items[${itemCount}][menu_item_id]`;
        newItem.querySelector('input').name = `items[${itemCount}][quantity]`;
        
        menuItems.appendChild(newItem);
        itemCount++;
    }
</script>
@endpush
@endsection