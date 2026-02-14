<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    /**
     * Affiche la liste de tous les services
     */
    public function index()
    {
        $services = Service::with('medecin')
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);
        
        return view('admin.services.index', compact('services'));
    }

    /**
     * Affiche le formulaire de création de service
     */
    public function create()
    {
        $medecins = User::where('role', 'medecin')->orderBy('name')->get();
        return view('admin.services.create', compact('medecins'));
    }

    /**
     * Enregistre un nouveau service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'prix' => ['required', 'numeric', 'min:0'],
            'duree' => ['required', 'integer', 'min:1'],
            'statut' => ['required', 'in:actif,inactif'],
            'medecin_id' => ['required', 'exists:users,id'],
        ], [
            'titre.required' => 'Le titre du service est requis',
            'description.required' => 'La description est requise',
            'prix.required' => 'Le prix est requis',
            'prix.numeric' => 'Le prix doit être un nombre',
            'duree.required' => 'La durée est requise',
            'duree.integer' => 'La durée doit être un nombre entier',
            'statut.required' => 'Le statut est requis',
            'medecin_id.required' => 'Un médecin doit être sélectionné',
        ]);

        Service::create($validated);

        return redirect()->route('admin.services')
                        ->with('success', 'Service créé avec succès');
    }

    /**
     * Affiche le formulaire d'édition d'un service
     */
    public function edit(Service $service)
    {
        $medecins = User::where('role', 'medecin')->orderBy('name')->get();
        return view('admin.services.edit', compact('service', 'medecins'));
    }

    /**
     * Met à jour un service existant
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'prix' => ['required', 'numeric', 'min:0'],
            'duree' => ['required', 'integer', 'min:1'],
            'statut' => ['required', 'in:actif,inactif'],
            'medecin_id' => ['required', 'exists:users,id'],
        ], [
            'titre.required' => 'Le titre du service est requis',
            'description.required' => 'La description est requise',
            'prix.required' => 'Le prix est requis',
            'prix.numeric' => 'Le prix doit être un nombre',
            'duree.required' => 'La durée est requise',
            'duree.integer' => 'La durée doit être un nombre entier',
            'statut.required' => 'Le statut est requis',
            'medecin_id.required' => 'Un médecin doit être sélectionné',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services')
                        ->with('success', 'Service modifié avec succès');
    }

    /**
     * Supprime un service
     */
    public function destroy(Service $service)
    {
        // Vérifier si le service a des réservations
        if ($service->reservations()->count() > 0) {
            return redirect()->route('admin.services')
                            ->with('error', 'Impossible de supprimer un service ayant des réservations');
        }

        $service->delete();

        return redirect()->route('admin.services')
                        ->with('success', 'Service supprimé avec succès');
    }
}