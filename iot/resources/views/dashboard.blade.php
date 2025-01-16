<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Drinks Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 mb-4">Drinks</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Manage Drinks Card -->
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-center">
                            <div class="mr-4 text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3z" />
                                </svg>
                            </div>
                            <div>
                                <a href="{{ route('drinks.index') }}" class="block">
                                    <h4 class="font-semibold text-lg text-gray-800">Manage Drinks</h4>
                                    <p class="text-sm text-gray-600">View and manage all drinks.</p>
                                </a>
                            </div>
                        </div>

                        <!-- Add New Drink Card -->
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md flex items-center">
                            <div class="mr-4 text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <a href="{{ route('drinks.create') }}" class="block">
                                    <h4 class="font-semibold text-lg text-gray-800">Add New Drink</h4>
                                    <p class="text-sm text-gray-600">Add a new drink to the list.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           <!-- Orders Section -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
    <div class="p-6 text-gray-900 h-full flex flex-col">
        <h3 class="font-semibold text-lg text-gray-800 mb-4">Orders</h3>
        <!-- Orders Table -->
        <div class="overflow-x-auto flex-grow">
            <table class="min-w-full border-collapse border border-gray-300 table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Drinks</th> <!-- Modify the column header for drinks -->
                        <th class="border border-gray-300 px-4 py-2 text-left">Payment Code</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Updated At</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Total Price</th> <!-- Add this column -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                            
                            <!-- Display the drink names -->
                            <td class="border border-gray-300 px-4 py-2">
                                @foreach ($order->drinks as $drink)
                                    {{ $drink->name }} ({{ $drink->pivot->quantity }})<br> <!-- Show drink name and quantity from pivot -->
                                @endforeach
                            </td>
                            
                            <td class="border border-gray-300 px-4 py-2">{{ $order->random_code }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ ucfirst($order->status) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $order->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ number_format($order->total_price) }} تومان</td> <!-- Display total price -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border border-gray-300 px-4 py-2 text-center text-gray-500">No orders available.</td>
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
