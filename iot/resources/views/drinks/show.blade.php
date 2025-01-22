<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drink Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Drink Details</h3>
                    <p><strong>Name:</strong> {{ $drink->name }}</p>
                    <p><strong>Price:</strong> {{ $drink->price }}</p>
                    <p><strong>Created At:</strong> {{ $drink->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $drink->updated_at->format('Y-m-d H:i') }}</p>
                    <a href="{{ route('drinks.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Back to Drinks</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
