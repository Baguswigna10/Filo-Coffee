<?php

namespace App\Http\Controllers;

use App\Models\TableReservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(private ReservationService $reservationService) {}

    public function index()
    {
        $reservations = auth()->check()
            ? TableReservation::where('user_id', auth()->id())->latest()->get()
            : collect();

        return view('pages.reservation', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:100',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guest_count'      => 'required|integer|min:1|max:20',
            'area'             => 'required|in:Indoor,Outdoor,Smoking',
            'special_request'  => 'nullable|string|max:500',
        ]);

        try {
            $reservation = $this->reservationService->createTableReservation($request->all());

            return redirect()->route('reservation.index')
                ->with('success', "Reservasi berhasil! Kode: {$reservation->reservation_code}. Kami akan konfirmasi segera.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function cancel(TableReservation $reservation)
    {
        if ($reservation->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($reservation->status === 'Confirmed') {
            return back()->with('error', 'Reservasi yang sudah dikonfirmasi tidak bisa dibatalkan. Hubungi kami.');
        }

        $reservation->update(['status' => 'Cancelled']);

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
