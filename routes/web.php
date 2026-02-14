<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PAGE D’ACCUEIL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD GÉNÉRAL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| SERVICES (TOUS LES UTILISATEURS CONNECTÉS)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Utilisateurs
    Route::resource('users', AdminUserController::class, [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]
    ]);

    // Services
    Route::resource('services', AdminServiceController::class, [
        'names' => [
            'index' => 'admin.services.index',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]
    ]);

    // Réservations
    Route::resource('reservations', AdminReservationController::class, [
        'names' => [
            'index' => 'admin.reservations.index',
            'show' => 'admin.reservations.show',
            'destroy' => 'admin.reservations.destroy',
        ]
    ]);
    Route::get('reservations/statistics/view', [AdminReservationController::class, 'statistics'])
        ->name('admin.reservations.statistics');
});

/*
|--------------------------------------------------------------------------
| MEDECIN
|--------------------------------------------------------------------------
*/

Route::prefix('medecin')->middleware(['auth', 'role:medecin'])->group(function () {

    Route::get('/dashboard', [MedecinController::class, 'dashboard'])
        ->name('medecin.dashboard');

    Route::get('/services', [MedecinController::class, 'services'])
        ->name('medecin.services');

    Route::patch('/reservations/{id}/statut', [MedecinController::class, 'updateStatus'])
        ->name('medecin.reservations.updateStatus');
});

/*
|--------------------------------------------------------------------------
| PATIENT
|--------------------------------------------------------------------------
*/

Route::prefix('patient')->middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/dashboard', [PatientController::class, 'dashboard'])
        ->name('patient.dashboard');

    // Réservations
    Route::get('/reservations/create/{service_id}', [ReservationController::class, 'create'])
        ->name('patient.reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])
        ->name('patient.reservations.store');
    Route::get('/mes-reservations', [ReservationController::class, 'myReservations'])
        ->name('patient.reservations.index');
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])
        ->name('patient.reservations.cancel');
});

require __DIR__.'/auth.php';