<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drinks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Drinks Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">All Drinks</h3>
                    <div class="mb-4">
                        <a href="{{ route('drinks.create') }}" class="px-4 py-2 bg-blue-500 text-black border border-blue-600 rounded-md hover:bg-blue-600">Add New Drink</a>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-black border border-blue-600 rounded-md hover:bg-blue-600">Back to Dashboard</a>

                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-300 table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($drinks as $drink)
                                    <tr class="odd:bg-white even:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2">{{ $drink->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $drink->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $drink->price }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('drinks.show', $drink) }}" class="text-blue-500 hover:underline">View</a>
                                            <a href="{{ route('drinks.edit', $drink) }}" class="text-yellow-500 hover:underline mx-2">Edit</a>
                                            <form action="{{ route('drinks.destroy', $drink) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center text-gray-500">No drinks available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
