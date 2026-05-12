<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_code', 'user_id', 'name', 'phone', 'email',
        'reservation_date', 'reservation_time', 'guest_count',
        'area', 'status', 'special_request', 'admin_notes',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'Pending'   => 'yellow',
            'Confirmed' => 'green',
            'Cancelled' => 'red',
            default     => 'gray',
        };
    }

    public static function generateCode(): string
    {
        return 'TBL-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    /**
     * Check if time slot is available for the given date and area
     */
    public static function isSlotAvailable(string $date, string $time, string $area, int $capacity = 10): bool
    {
        $count = self::where('reservation_date', $date)
            ->where('reservation_time', $time)
            ->where('area', $area)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->count();

        return $count < $capacity;
    }
}
