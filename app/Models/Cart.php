<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'menu_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getSubtotalAttribute(): float
    {
        $price = $this->product_id ? $this->product->price : $this->menu->price;
        return $this->quantity * $price;
    }
}
