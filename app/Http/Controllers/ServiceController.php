<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('statut', 'actif')
            ->with('medecin')
            ->get();

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        $service->load('medecin');

        return view('services.show', compact('service'));
    }
}