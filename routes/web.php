<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstantRecordController;
use App\Http\Controllers\configsController;
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


// --------------| Configuration Page |----------------------------------------

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/manage/configs', [configsController::class, 'manageConfigs'])->name('manage.configs');
    Route::post('/save/year', [configsController::class, 'saveYear'])->name('save.year');
    Route::post('activate/year', [configsController::class, 'activateYear'])->name('activate.year');
    Route::get('edit/year/{id}', [configsController::class, 'editYear'])->name('edit.year');
    Route::get('update/year', [configsController::class, 'updateYear'])->name('update.year');
});



// --------------| Instant Records |----------------------------------------

Route::post('/save/donation', [InstantRecordController::class, 'saveDonation'])->name('save.donation');
Route::post('/save/expense', [InstantRecordController::class, 'saveExpense'])->name('save.expense');
Route::post('/verify/donation', [InstantRecordController::class, 'verifyDonation'])->name('verify.donation');

require __DIR__.'/auth.php';