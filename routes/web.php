<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstantRecordController;
use App\Http\Controllers\yearEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --------------| Instant Records |----------------------------------------

Route::post('/save/donation', [InstantRecordController::class, 'saveDonation'])->name('save.donation');

require __DIR__.'/auth.php';


// --------------| Create Year |----------------------------------------

Route::get('/create/year/event', [yearEventController::class, 'create'])->name('create.year.event');

Route::post('/save/year', [yearEventController::class, 'saveYear'])->name('save.year');
Route::post('activate/year', [yearEventController::class, 'activateYear'])->name('activate.year');