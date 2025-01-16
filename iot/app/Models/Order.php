<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['drink_id', 'random_code', 'status', 'payment_method'];

    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'order_drink')
            ->withPivot('quantity') // Include quantity from pivot table
            ->withTimestamps(); // Automatically manage timestamps for pivot table
    }
}
