<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_drink')
            ->withPivot('quantity') // Include quantity from pivot table
            ->withTimestamps(); // Automatically manage timestamps for pivot table
    }
}