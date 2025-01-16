<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Drink') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">New Drink</h3>
                    <form action="{{ route('drinks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Drink Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Drink Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="w-full px-4 py-2 border rounded-md @error('name') border-red-500 @enderror" 
                                value="{{ old('name') }}" 
                                required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Drink Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                class="w-full px-4 py-2 border rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700">Price</label>
                            <input 
                                type="number" 
                                id="price" 
                                name="price" 
                                class="w-full px-4 py-2 border rounded-md @error('price') border-red-500 @enderror" 
                                value="{{ old('price') }}" 
                                min="0" 
                                required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Drink Image -->
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image</label>
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                class="w-full px-4 py-2 border rounded-md @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button 
                                type="submit" 
                                class="px-4 py-2 bg-blue-500 text-black border border-blue-600 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Add Drink
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
