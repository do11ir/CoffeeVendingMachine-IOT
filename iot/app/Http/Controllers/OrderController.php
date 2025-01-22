<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        $drinks = json_decode($request->drinks, true);  // Decode to array
        if (!is_array($drinks) || empty($drinks)) {
            Log::error('Invalid drinks data format');
            return redirect()->back()->withErrors(['drinks' => 'Invalid drinks data format']);
        }
        foreach ($drinks as $drinkData) {
            if (!isset($drinkData['drink_id']) || !isset($drinkData['quantity'])) {
                return redirect()->back()->withErrors(['drinks' => 'Missing drink_id or quantity in one or more items']);
            }

            // Validate drink_id and quantity manually here if needed
            if (!is_int($drinkData['quantity']) || $drinkData['quantity'] <= 0) {
                return redirect()->back()->withErrors(['drinks' => 'Invalid quantity for drink ' . $drinkData['drink_id']]);
            }

            // Check if the drink_id exists in the database (You can do this in a batch query to optimize)
            $drinkExists = Drink::find($drinkData['drink_id']);
            if (!$drinkExists) {
                return redirect()->back()->withErrors(['drinks' => 'Drink with ID ' . $drinkData['drink_id'] . ' does not exist']);
            }
        }
        // Extract the payment_method from the request
        $payment_method = $request->payment_method;
        // Validate the payment method (now explicitly accessing the variable)
        $validated = $request->validate([
            'payment_method' => 'required|string',
        ]);
        // Start a database transaction to ensure consistency
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'random_code' => strtoupper(uniqid('ORD')), // Generate a unique random order code
                'payment_method' => $payment_method,  // Use the extracted $payment_method
                'status' => 'pending', // Assuming the order starts with 'pending' status
            ]);
            // Prepare an array for the pivot data (order_drink)
            $orderDrinks = [];
            foreach ($drinks as $drinkData) {
                $orderDrinks[$drinkData['drink_id']] = [
                    'quantity' => $drinkData['quantity'],
                ];
            }
            // Attach drinks to the order using the pivot table
            $order->drinks()->attach($orderDrinks);
            // Commit the transaction
            DB::commit();
            // Redirect to the confirmation page (or any other page)
            return redirect()->route('order.confirmation', ['order' => $order->id]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            DB::rollback();
            // Return an error view with message and exception
            return view('order.error', [
                'message' => 'An error occurred while placing the order.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function confirmation($orderId)
    {
        $order = Order::with('drinks')->findOrFail($orderId);
        return view('PaymentSuccess', ['order' => $order]);
    }
}
