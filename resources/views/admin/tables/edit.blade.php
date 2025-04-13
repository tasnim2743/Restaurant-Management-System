@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Table #{{ $table->table_number }}</h2>
                    <p class="mt-1 text-sm text-gray-600">Modify table details and settings</p>
                </div>

                <form action="{{ route('admin.tables.update', $table) }}" method="POST" class="max-w-2xl">
            @csrf
            @method('PUT')

                    <div class="space-y-6">
                        <!-- Table Number -->
                <div>
                            <label for="table_number" class="block text-sm font-medium text-gray-700">Table Number</label>
                            <div class="mt-1">
                                <input type="text" name="table_number" id="table_number" required
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('table_number', $table->table_number) }}">
                            </div>
                    @error('table_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                        <!-- Capacity -->
                <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Seating Capacity</label>
                            <div class="mt-1">
                                <input type="number" name="capacity" id="capacity" required min="1"
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                    value="{{ old('capacity', $table->capacity) }}">
                            </div>
                    @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <div class="mt-1">
                                <select name="location" id="location"
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="main" {{ $table->location == 'main' ? 'selected' : '' }}>Main Dining Area</option>
                                    <option value="outdoor" {{ $table->location == 'outdoor' ? 'selected' : '' }}>Outdoor Patio</option>
                                    <option value="private" {{ $table->location == 'private' ? 'selected' : '' }}>Private Room</option>
                                    <option value="bar" {{ $table->location == 'bar' ? 'selected' : '' }}>Bar Area</option>
                                </select>
                            </div>
                            @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Current Status</label>
                            <div class="mt-1">
                                <select name="status" id="status"
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="available" {{ $table->status == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="occupied" {{ $table->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                    <option value="reserved" {{ $table->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                    <option value="maintenance" {{ $table->status == 'maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                </select>
                            </div>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                                <span class="text-gray-400">(Optional)</span>
                            </label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="3"
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $table->description) }}</textarea>
                            </div>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('admin.tables.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                Update Table
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Danger Zone -->
                <div class="mt-10 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
                    <div class="mt-3">
                        <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                onclick="return confirm('Are you sure you want to delete this table? This action cannot be undone.')">
                                Delete Table
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection