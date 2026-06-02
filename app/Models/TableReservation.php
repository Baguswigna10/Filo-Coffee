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
        'area', 'table_number', 'status', 'special_request', 'admin_notes',
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
     * Get predefined list of tables grouped by area/space type
     */
    public static function getTablesList(): array
    {
        return [
            'Indoor' => [
                'Meja 1 (2 Kursi)',
                'Meja 2 (2 Kursi)',
                'Meja 3 (4 Kursi)',
                'Meja 4 (4 Kursi)',
                'Meja 5 (6 Kursi)',
                'Meja 6 (6 Kursi)',
                'Meja 7 (8 Kursi)',
                'Meja 8 (8 Kursi)',
            ],
            'Outdoor' => [
                'Meja 9 (2 Kursi)',
                'Meja 10 (2 Kursi)',
                'Meja 11 (4 Kursi)',
                'Meja 12 (4 Kursi)',
                'Meja 13 (6 Kursi)',
                'Meja 14 (6 Kursi)',
            ],
            'Smoking' => [
                'Meja 15 (2 Kursi)',
                'Meja 16 (4 Kursi)',
                'Meja 17 (4 Kursi)',
            ],
            'Working Space' => [
                'Workspace A (Single - AC)',
                'Workspace B (Single - AC)',
                'Workspace C (Double - AC)',
                'Workspace D (Double - AC)',
                'Workspace E (Group/Meeting - AC)',
            ],
            'Private Room' => [
                'Private Room VIP 1 (Max 8 Orang - Smart TV/AC)',
                'Private Room VIP 2 (Max 12 Orang - Smart TV/AC)',
            ],
        ];
    }

    /**
     * Check if a specific table is already booked for the given date and time
     */
    public static function isTableBooked(string $date, string $time, string $tableNumber): bool
    {
        return self::where('reservation_date', $date)
            ->where('reservation_time', $time)
            ->where('table_number', $tableNumber)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->exists();
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
