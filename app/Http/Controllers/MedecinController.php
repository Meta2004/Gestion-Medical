<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MedecinController extends Controller
{
    public function dashboard()
    {
        $reservations = Reservation::with(['service','user'])
            ->whereHas('service', function ($q) {
                $q->where('medecin_id', Auth::id());
            })
            ->orderBy('date_reservation', 'desc')
            ->get();

        return view('dashboard.medecin', compact('reservations'));
    }

    public function services()
    {
        $services = Service::where('medecin_id', Auth::id())->get();
        return view('medecin.services', compact('services'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee,effectuee',
        ]);

        $reservation = Reservation::with('service')->findOrFail($id);

        // Sécurité : vérifier que le médecin est propriétaire du service
        if ($reservation->service->medecin_id !== Auth::id()) {
            abort(403);
        }

        // Empêcher modification si déjà annulée ou effectuée
        if (in_array($reservation->statut, ['annulee', 'effectuee'])) {
            return back()->with('error', 'Impossible de modifier cette réservation.');
        }

        $reservation->update($validated);

        return back()->with('success', 'Statut mis à jour.');
    }
}