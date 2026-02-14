<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Affiche le tableau de bord administrateur
     */
    public function index()
    {
        // Compter les utilisateurs par rôle
        $usersCount = User::count();
        $medecinsCount = User::where('role', 'medecin')->count();
        $patientsCount = User::where('role', 'patient')->count();
        
        // Compter les réservations
        $reservationsCount = Reservation::count();
        
        // Compter les services
        $servicesCount = Service::count();
        
        // Récupérer les 5 dernières réservations
        $latestReservations = Reservation::with(['user', 'service.medecin'])
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get();

        return view('dashboard.admin', compact(
            'usersCount',
            'medecinsCount',
            'patientsCount',
            'reservationsCount',
            'servicesCount',
            'latestReservations'
        ));
    }
}
