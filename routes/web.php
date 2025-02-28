<?php

use App\Models\User;
use App\Livewire\HomePage;
use App\Livewire\Client\Profile;
use App\Livewire\CreateEntreprise;
use App\Livewire\Client\HomeClient;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Payment\PricingPlan;
use Illuminate\Support\Facades\Route;
use App\Livewire\Payment\FactureClient;
use App\Livewire\Client\CreateInstances;
use App\Livewire\Payment\PaymentProcess;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OtpVerificationController;

// Redirection de base
Route::redirect('/', '/accueil');
Route::get('/accueil', HomePage::class)->name('homepage');

// Routes d'authentification
Route::middleware(['guest'])->group(function () {
    Route::get('inscription', [RegisterController::class, 'showRegistrationForm'])->name('inscription');
    Route::post('inscription', [RegisterController::class, 'inscription']);
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Vérification OTP
    Route::get('verify-otp', [OtpVerificationController::class, 'show'])->name('verification.notice');
    Route::post('verify-otp', [OtpVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('verify-otp/resend', [OtpVerificationController::class, 'resend'])->name('verification.resend');

    // Redirection après login
    Route::get('/dashboard', function () {
        return redirect()->route('espaceClient');
    })->name('dashboard');

    // Profil
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::get('/profile/check', 'checkCompletion')->name('profile.check');
    });

    // Routes principales (nécessitent un profil complété)
    Route::middleware(['verified', 'profile.complete'])->group(function () {

        // Espace client (mettre en premier pour la priorité)
        Route::prefix('client-espace')->group(function () {
            Route::get('/client', HomeClient::class)->name('espaceClient');
            Route::get('/instances', HomeClient::class)->name('instances.list');
        });


        // Routes secondaires
        Route::get('/offres/plans', PricingPlan::class)->name('plans.selection');
        Route::get('/payment/process/{uuid}', PaymentProcess::class)->name('payment.process');

        Route::get('/entreprise/create', CreateEntreprise::class)->name('entreprise.create');
        Route::get('/instance/create', CreateInstances::class)->name('instance.create');


        Route::get('/payment/upgrade/{uuid}/{instance?}', PaymentProcess::class)->name('payment.upgrade');
    });


});
