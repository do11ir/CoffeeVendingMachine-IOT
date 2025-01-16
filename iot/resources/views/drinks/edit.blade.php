<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Drink') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Edit Drink</h3>
                    <form action="{{ route('drinks.update', $drink) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Drink Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" value="{{ $drink->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700">Price</label>
                            <input type="number" id="price" name="price" class="w-full px-4 py-2 border rounded-md" value="{{ $drink->price }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description (Optional)</label>
                            <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-md">{{ $drink->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700">Image (Optional)</label>
                            <input type="file" id="image" name="image" class="w-full px-4 py-2 border rounded-md">
                            @if ($drink->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($drink->image) }}" alt="Drink Image" class="w-32 h-32 object-cover">
                                </div>
                            @else
                                <p>No image available.</p>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-yellow-500 text-black border border-blue-600 rounded-md hover:bg-yellow-600">Update Drink</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
