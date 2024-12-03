<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\MailDashboard;
use App\Http\Controllers\EmailController;
// Route for the login page
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/send-test-email', [EmailController::class, 'sendTestEmail']);


// Middleware for authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', MailDashboard::class)->name('dashboard');
});
