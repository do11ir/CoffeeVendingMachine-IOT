<?php

use App\Models\Drink;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    // Fetch all drinks from the database
    $drinks = Drink::all();
    // Return the index view and pass the drinks data to it
    return view('index', compact('drinks'));
})->name('index');

Route::get('/buybox', function () {
    $drinks = Drink::all()->map(function ($drink) {
        return [
            'id' => $drink->id,
            'name' => $drink->name,
            'price' => $drink->price,
            'image' => $drink->image,
        ];
    });

    return view('buybox', compact('drinks'));
})->name('buybox');

Route::post('/order/submit', [OrderController::class, 'submitOrder'])->name('submitOrder');
Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');


Route::get('/dashboard', function () {
    $orders = \App\Models\Order::all(); // Fetch all orders
    $orders->each(function($order) {
        $totalPrice = 0;

        // Loop through each associated drink and calculate total price
        foreach ($order->drinks as $drink) {
            $totalPrice += $drink->pivot->quantity * $drink->price; // Calculate price based on quantity and drink price
        }

        $order->total_price = $totalPrice; // Store the calculated total price
    });

    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grouped routes for better organization
Route::group(['prefix' => 'drinks', 'as' => 'drinks.'], function () {
    Route::get('/', [DrinkController::class, 'index'])->name('index');       // List all drinks
    Route::get('/create', [DrinkController::class, 'create'])->name('create'); // Form to add a new drink
    Route::post('/', [DrinkController::class, 'store'])->name('store');       // Save a new drink
    Route::get('/{drink}', [DrinkController::class, 'show'])->name('show');   // View a specific drink
    Route::get('/{drink}/edit', [DrinkController::class, 'edit'])->name('edit'); // Form to edit a drink
    Route::put('/{drink}', [DrinkController::class, 'update'])->name('update'); // Update a drink
    Route::delete('/{drink}', [DrinkController::class, 'destroy'])->name('destroy'); // Delete a drink
});

require __DIR__.'/auth.php';
