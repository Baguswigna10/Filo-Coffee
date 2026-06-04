<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PsReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_code', 'user_id', 'name', 'phone',
        'reservation_date', 'start_time', 'duration', 'end_time',
        'console_type', 'total_price', 'status', 'notes', 'admin_notes',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    // Pricing per hour
    const PRICE_PS4 = 15000;
    const PRICE_PS5 = 25000;

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
            'Completed' => 'blue',
            default     => 'gray',
        };
    }

    public static function generateCode(): string
    {
        return 'PS-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    public static function getPricePerHour(string $consoleType): int
    {
        return $consoleType === 'PS5' ? self::PRICE_PS5 : self::PRICE_PS4;
    }

    /**
     * Check for time slot conflicts for a given console type & date
     */
    public static function hasConflict(string $date, string $startTime, string $endTime, string $consoleType, ?int $excludeId = null): bool
    {
        $query = self::where('reservation_date', $date)
            ->where('console_type', $consoleType)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->where(function ($q) use ($startTime, $endTime) {
                // Overlapping: existing.start < new.end AND existing.end > new.start
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
