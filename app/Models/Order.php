<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 'subtotal', 'shipping_cost', 'total_price',
        'payment_method', 'status', 'shipping_address', 'shipping_city',
        'shipping_province', 'shipping_zip', 'recipient_name', 'recipient_phone',
        'notes', 'payment_proof', 'midtrans_token', 'paid_at', 'shipped_at', 'completed_at',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'Pending'    => 'yellow',
            'Paid'       => 'blue',
            'Processing' => 'indigo',
            'Shipped'    => 'purple',
            'Completed'  => 'green',
            'Cancelled'  => 'red',
            default      => 'gray',
        };
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public static function generateOrderNumber(): string
    {
        return 'KN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
