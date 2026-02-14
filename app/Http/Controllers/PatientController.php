<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
    {
        $reservations = auth()->user()->reservations()->with('service.medecin')->get();
        return view('dashboard.patient', compact('reservations'));
    }
}