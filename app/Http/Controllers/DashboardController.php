<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'medecin') {
            return redirect()->route('medecin.dashboard');
        }

        if ($user->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }

        abort(403);
    }
}
