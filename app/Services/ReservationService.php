<?php

namespace App\Services;

use App\Models\TableReservation;
use App\Models\PsReservation;
use Carbon\Carbon;

class ReservationService
{
    // Operating hours
    const OPEN_HOUR = '08:00';
    const CLOSE_HOUR = '22:00';
    const TABLE_CAPACITY_PER_SLOT = 5; // max 5 simultaneous bookings per area slot

    public function createTableReservation(array $data): TableReservation
    {
        $this->validateTableSlot($data);

        return TableReservation::create([
            'reservation_code' => TableReservation::generateCode(),
            'user_id'          => auth()->id(),
            'name'             => $data['name'],
            'phone'            => $data['phone'],
            'email'            => $data['email'],
            'reservation_date' => $data['reservation_date'],
            'reservation_time' => $data['reservation_time'],
            'guest_count'      => $data['guest_count'],
            'area'             => $data['area'],
            'status'           => 'Pending',
            'special_request'  => $data['special_request'] ?? null,
        ]);
    }

    public function validateTableSlot(array $data): void
    {
        $date = Carbon::parse($data['reservation_date']);

        if ($date->isPast() && !$date->isToday()) {
            throw new \Exception('Tidak bisa booking tanggal yang telah lewat.');
        }

        $time = $data['reservation_time'];
        if ($time < self::OPEN_HOUR || $time >= self::CLOSE_HOUR) {
            throw new \Exception('Jam operasional kami: ' . self::OPEN_HOUR . ' - ' . self::CLOSE_HOUR . '.');
        }

        if (!TableReservation::isSlotAvailable($data['reservation_date'], $time, $data['area'], self::TABLE_CAPACITY_PER_SLOT)) {
            throw new \Exception('Slot waktu dan area ini sudah penuh. Silahkan pilih waktu atau area lain.');
        }
    }

    public function createPsReservation(array $data): PsReservation
    {
        $startTime = $data['start_time'];
        $duration  = (int) $data['duration'];
        $endTime   = Carbon::parse($data['reservation_date'] . ' ' . $startTime)
                        ->addHours($duration)
                        ->format('H:i');

        $this->validatePsSlot($data, $endTime);

        $pricePerHour = PsReservation::getPricePerHour($data['console_type']);
        $totalPrice   = $pricePerHour * $duration;

        return PsReservation::create([
            'reservation_code' => PsReservation::generateCode(),
            'user_id'          => auth()->id(),
            'name'             => $data['name'],
            'phone'            => $data['phone'],
            'reservation_date' => $data['reservation_date'],
            'start_time'       => $startTime,
            'duration'         => $duration,
            'end_time'         => $endTime,
            'console_type'     => $data['console_type'],
            'total_price'      => $totalPrice,
            'status'           => 'Pending',
            'notes'            => $data['notes'] ?? null,
        ]);
    }

    public function validatePsSlot(array $data, string $endTime): void
    {
        $date = Carbon::parse($data['reservation_date']);

        if ($date->isPast() && !$date->isToday()) {
            throw new \Exception('Tidak bisa booking tanggal yang telah lewat.');
        }

        if ($data['start_time'] < self::OPEN_HOUR || $endTime > self::CLOSE_HOUR) {
            throw new \Exception('Jam operasional kami: ' . self::OPEN_HOUR . ' - ' . self::CLOSE_HOUR . '.');
        }

        if (PsReservation::hasConflict($data['reservation_date'], $data['start_time'], $endTime, $data['console_type'])) {
            throw new \Exception('Slot waktu ' . $data['console_type'] . ' ini sudah dipesan. Silahkan pilih waktu lain.');
        }
    }
}
