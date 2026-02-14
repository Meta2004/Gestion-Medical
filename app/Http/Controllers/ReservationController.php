<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create($service_id)
    {
        $service = Service::findOrFail($service_id);
        return view('reservations.create', compact('service'));
        //dd(auth()->user());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_reservation' => 'required',
            'commentaire' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['statut'] = 'en_attente';

        Reservation::create($validated);

        return redirect()->route('patient.reservations.index')
            ->with('success', 'Réservation enregistrée.');
    }

    public function myReservations()
    {
        $reservations = Reservation::with('service')
            ->where('user_id', Auth::id())
            ->orderBy('date_reservation', 'desc')
            ->paginate(10);

        return view('reservations.patient_index', compact('reservations'));
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        if ($reservation->statut !== 'en_attente') {
            return back()->with('error', 'Impossible d’annuler cette réservation.');
        }

        $reservation->update(['statut' => 'annulee']);

        return back()->with('success', 'Réservation annulée.');
    }
}