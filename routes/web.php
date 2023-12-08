<?php

use App\Http\Controllers\ProfileController;
use App\AppHelpers;
use App\Http\Controllers\InstantRecordController;
use App\Http\Controllers\RegisteredRecordController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonorController;
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

Route::post('login', [ 'as' => 'login', 'uses' => 'AuthenticatedSessionController@create']);

Route::get('/dashboard', function () {
    return view('admin.dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Configuration Page
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/manage/year', [YearController::class, 'manageYear'])->name('manage.year');

// --------------| Manage Financial year |----------------------------------------
    Route::post('/save/year', [YearController::class, 'saveYear'])->name('save.year');
    Route::post('activate/year', [YearController::class, 'activateYear'])->name('activate.year');
    Route::get('edit/year/{id}', [YearController::class, 'editYear'])->name('edit.year');
    Route::post('update/year', [YearController::class, 'updateYear'])->name('update.year');

    Route::get('/manage/event', [EventController::class, 'manageEvent'])->name('manage.event');
    Route::post('update/event', [EventController::class, 'updateEvent'])->name('update.event');

// --------------| Events |----------------------------------------
    Route::post('/save/event', [EventController::class, 'saveEvent'])->name('save.event');
    Route::post('activate/event', [EventController::class, 'activateEvent'])->name('activate.event');

// --------------| Donors |----------------------------------------
    Route::get('/manage/donor', [DonorController::class, 'manageDonor'])->name('manage.donor');
    Route::get('/get/donor/{id}', [DonorController::class, 'getDonor'])->name('get.donor');
    Route::get('/activate/donors', [DonorController::class, 'activateDonors'])->name('activate.donors');
    Route::post('/save/donor', [DonorController::class, 'saveDonor'])->name('save.donor');
    Route::post('activate/donor', [DonorController::class, 'activateDonor'])->name('activate.donor');
    Route::post('update/donor', [DonorController::class, 'updateDonor'])->name('update.donor');
});



/*
|--------------------------------------------------------------------------
| Instant Records
|--------------------------------------------------------------------------
|
*/
// --------------| For the Dashboard |-------------------------------------

Route::controller(InstantRecordController::class)->group(function () {

Route::post('/save/donation', 'saveDonation')->name('save.donation');
Route::post('/save/expense', 'saveExpense')->name('save.expense');
Route::post('/verify/donation', 'verifyDonation')->name('verify.donation');


// --------------| For Pages |----------------------------------------

Route::get('/get/instant/records', 'getAllInstantRecords')->name('get.instant.records');
Route::post('/update/transaction', 'updateTransaction')->name('update.transaction');

// --------------| Unpaid Donations |----------------------------------------
Route::get('/instant/unpaid/donations', 'getUnpaidDonations')->name('instant.unpaid.donations');
Route::get('/instant/prev_unpaid/donations', 'prevUnpaidDonations')->name('instant.prev_unpaid.donations');
Route::get('/instant/edit/pledges', 'editPledges')->name('instant.edit.pledges');
Route::post('/instant/redeem_a_pledge', 'redeemAPledge')->name('instant.redeem_a_pledge');
Route::get('/instant/edit/pledges', 'editPledges')->name('instant.edit.pledges');
Route::post('/instant/redeem_pledges', 'redeemPledges')->name('instant.redeem_pledges');

// --------------| Verified Donations |----------------------------------------
Route::get('/instant/verified/donations', 'getVerifiedDonations')->name('instant.verified.donations');
Route::get('/instant/prev_verified/donations', 'prevVerifiedDonations')->name('instant.prev_verified.donations');

// --------------| Unverified Donations |----------------------------------------
Route::get('/instant/unverified/donations', 'getUnverifiedDonations')->name('instant.unverified.donations');
Route::post('/instant/verify_a_donation', 'verifyADonation')->name('instant.verify_a_donation');
Route::get('/instant/prev_unverified/donations', 'prevUnverifiedDonations')->name('instant.prev_unverified.donations');

// --------------| Expenses |---------------------------------------------------
Route::get('/expenses', 'getExpenses')->name('get.expenses');
Route::get('/instant/prev_expenses', 'prevExpenses')->name('instant.prev_expenses');

});



/*
|--------------------------------------------------------------------------
| Registered Records
|--------------------------------------------------------------------------
|
*/
// --------------| Add donor (Dashboard) |---------------------------------

Route::controller(DonorController::class)->group(function () {

Route::post('/save/donor', 'saveDonor')->name('save.donor');

});

// --------------| Add Donation (Dashboard) |----------------------------------

Route::controller(RegisteredRecordController::class)->group(function () {

Route::post('/save/donation', 'saveDonation')->name('save.donation');

});

 // Route::post('/save/donor', [DonorController::class, 'saveDonor'])->name('save.donor');

require __DIR__.'/auth.php';