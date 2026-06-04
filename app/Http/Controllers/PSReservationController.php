<?php

namespace App\Http\Controllers;

use App\Models\PsReservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class PSReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService) {}

    public function index()
    {
        $reservations = auth()->check()
            ? PsReservation::where('user_id', auth()->id())->latest()->get()
            : collect();

        $ps4Price = PsReservation::PRICE_PS4;
        $ps5Price = PsReservation::PRICE_PS5;

        return view('pages.playstation', compact('reservations', 'ps4Price', 'ps5Price'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'phone'            => 'required|string|max:20',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time'       => 'required|date_format:H:i',
            'duration'         => 'required|integer|min:1|max:8',
            'console_type'     => 'required|in:PS4,PS5',
            'notes'            => 'nullable|string|max:500',
        ]);

        try {
            $reservation = $this->reservationService->createPsReservation($request->all());

            return redirect()->route('playstation.index')
                ->with('success', "Booking PS berhasil! Kode: {$reservation->reservation_code}. Total: Rp " . number_format($reservation->total_price, 0, ',', '.'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function cancel(PsReservation $psReservation)
    {
        if ($psReservation->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $psReservation->update(['status' => 'Cancelled']);
        return back()->with('success', 'Booking PS berhasil dibatalkan.');
    }
}
