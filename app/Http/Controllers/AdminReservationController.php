<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    /**
     * Affiche la liste de toutes les réservations
     */
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'service.medecin']);

        // Filtrage par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtrage par médecin
        if ($request->filled('medecin_id')) {
            $query->whereHas('service', function ($q) {
                $q->where('medecin_id', request()->medecin_id);
            });
        }

        // Filtrage par patient
        if ($request->filled('patient_id')) {
            $query->where('user_id', $request->patient_id);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('service', function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%");
            });
        }

        $reservations = $query->orderBy('date_reservation', 'desc')
                             ->paginate(15);

        $medecins = User::where('role', 'medecin')->orderBy('name')->get();
        $patients = User::where('role', 'patient')->orderBy('name')->get();
        $statuts = ['pending', 'confirmed', 'completed', 'cancelled'];

        return view('admin.reservations.index', compact(
            'reservations', 
            'medecins', 
            'patients', 
            'statuts'
        ));
    }

    /**
     * Affiche les détails d'une réservation
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'service.medecin']);
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Supprime une réservation (avec confirmation)
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations')
                        ->with('success', 'Réservation supprimée avec succès');
    }

    /**
     * Affiche les statistiques des réservations
     */
    public function statistics()
    {
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('statut', 'pending')->count();
        $confirmedReservations = Reservation::where('statut', 'confirmed')->count();
        $completedReservations = Reservation::where('statut', 'completed')->count();
        $cancelledReservations = Reservation::where('statut', 'cancelled')->count();

        return view('admin.reservations.statistics', compact(
            'totalReservations',
            'pendingReservations',
            'confirmedReservations',
            'completedReservations',
            'cancelledReservations'
        ));
    }
}