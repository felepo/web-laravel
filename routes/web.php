<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

Route::post('answers/{question}', [AnswerController::class, 'store'])->name('answers.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
