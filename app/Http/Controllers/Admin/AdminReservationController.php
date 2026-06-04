<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TableReservation;
use App\Models\PsReservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function tableIndex(Request $request)
    {
        $reservations = TableReservation::with('user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->where('reservation_date', $request->date))
            ->latest()
            ->paginate(20);

        return view('admin.reservations.table-index', compact('reservations'));
    }

    public function tableUpdateStatus(Request $request, TableReservation $tableReservation)
    {
        $request->validate([
            'status'      => 'required|in:Pending,Confirmed,Cancelled',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $tableReservation->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Status reservasi diperbarui.');
    }

    public function psIndex(Request $request)
    {
        $reservations = PsReservation::with('user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->console, fn($q) => $q->where('console_type', $request->console))
            ->when($request->date, fn($q) => $q->where('reservation_date', $request->date))
            ->latest()
            ->paginate(20);

        return view('admin.reservations.ps-index', compact('reservations'));
    }

    public function psUpdateStatus(Request $request, PsReservation $psReservation)
    {
        $request->validate([
            'status'      => 'required|in:Pending,Confirmed,Cancelled,Completed',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $psReservation->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Status booking PS diperbarui.');
    }
}
