<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'total_price',
        'cash_received',
        'cash_change',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'cash_received' => 'decimal:2',
        'cash_change' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PosTransactionItem::class);
    }

    public static function generateTransactionNumber()
    {
        return 'POS-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
