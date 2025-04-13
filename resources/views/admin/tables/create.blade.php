@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Add New Table</h2>
                    <p class="mt-1 text-sm text-gray-600">Create a new table in your restaurant</p>
                </div>

                <form action="{{ route('admin.tables.store') }}" method="POST" class="max-w-2xl">
                    @csrf
                    <div class="space-y-6">
                        <!-- Table Number -->
                        <div>
                            <label for="table_number" class="block text-sm font-medium text-gray-700">Table Number</label>
                            <div class="mt-1">
                                <input type="text" name="table_number" id="table_number" required
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="e.g., T01">
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
                                    placeholder="Number of seats">
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
                                    <option value="main">Main Dining Area</option>
                                    <option value="outdoor">Outdoor Patio</option>
                                    <option value="private">Private Room</option>
                                    <option value="bar">Bar Area</option>
                                </select>
                            </div>
                            @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Initial Status</label>
                            <div class="mt-1">
                                <select name="status" id="status"
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="available">Available</option>
                                    <option value="maintenance">Under Maintenance</option>
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
                                    class="shadow-sm focus:ring-[#C8A97E] focus:border-[#C8A97E] block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Additional details about the table..."></textarea>
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
                                Create Table
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection