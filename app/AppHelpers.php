<?php
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use App\Models\Donor;
use Carbon\Carbon;


//format time
function formatTime($createdAt) {
    $actTime = Carbon::parse($createdAt);
    $minutesDiff = Carbon::now()->diffInMinutes($actTime);

    if ($minutesDiff < 1) {
        $actTime = 'now';
    } elseif ($minutesDiff < 60) {
        $actTime = $minutesDiff . ' minutes ago';
    } elseif ($minutesDiff < 1440) {
        $actTime = 'Today';
    } else {
        $actTime = 'Yesterday';
    }

    return $actTime;
}

//Get activity details
function getActivityLogDetails(Activity $activity)
{
    $user = User::find($activity->causer_id);
    $donor = Donor::find($activity->properties['attributes']['donor_id']);
   
    $actTime = formatTime($activity->created_at);

    return [
        'userName' => $user->name ?? 'Unknown User',
        'donorName' => $donor->name ?? 'Unknown Donor',
        'amount' => $activity->properties['attributes']['amount'],
        'actTime' => $actTime,
        'paymentMode' => match($activity->properties['attributes']['payment_mode']) {
            1 => 'by cash',
            2 => 'by POS',
            3 => 'through bank transfer',
            default => 'through pledge',
        },
        'paymentStatus' => match($activity->properties['attributes']['payment_status'] ?? null) {
            0 => 'pledge',
            default => 'donation',
        },
    ];
}

// Log activities
if (!function_exists('logActivity')) {
    function logActivity()
    {
        $activities = Activity::latest()->get();

        if ($activities->isEmpty()) {
            return []; // Return an empty array if no activities are found
        }

        $activityDetails = [];

        foreach ($activities as $activity) {
            $activityDetails[] = getActivityLogDetails($activity);
        }

        return $activityDetails;
    }
}



// Get user's id
if (!function_exists('isAdmin')) {
    function isAdmin()
    {
    $isAdmin = auth()->user()->hasAnyRole(['cheif-admin', 'admin']);     
     return $isAdmin;
    }
}

// Get user's id
if (!function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
     $userId = Auth::id();
     
     return $userId;
    }
}

// Get current year
if (!function_exists('getCurrentYear')) {
    function getCurrentYear()
    {
     $currentYear = App\Models\YearRecord::where('status', 1)->first();
     
     return $currentYear->year;
    }
}

// Get current event
if (!function_exists('getCurrentEvent')) {
    function getCurrentEvent()
    {
     $currentEvent = App\Models\Event::where('status', 1)->first();

     if($currentEvent) {
        $currentEvent = $currentEvent->id;
     } else {
        $currentEvent = 'No event';
     }
     
     return $currentEvent;
    }
}
// Get current event
if (!function_exists('getCurrentEventName')) {
    function getCurrentEventName()
    {
     $currentEvent = App\Models\Event::where('status', 1)->first();

     if($currentEvent) {
        $currentEvent = $currentEvent->name;
     } else {
        $currentEvent = 'No event';
     }
     
     return $currentEvent;
    }
}

// Get Modules 
if (!function_exists('getModules')) {
    function getModules()
    {
     $modules = App\Models\Module::all()->sortBy('order');
     
     return $modules; 
    }
}

// // Get Permission 
// if (!function_exists('getModules')) {
//     function getModules()
//     {
//      $modules = App\Models\Module::all()->sortBy('order');
     
//      return $modules; 
//     }
// }

// Get donor donation event
if (!function_exists('getDonorDonationEvent')) {
    function getDonorDonationEvent($id)
    {
     $donorDonationEvent = App\Models\RegisteredRecord::where('donor_id', $id)->first();

     $donorDonationEvent = $donorDonationEvent->event_id;

     // echo $donorDonationEvent;
     // exit();
     
     return $donorDonationEvent;
    }
}

// Extract initials from user's name
if (!function_exists('getUserInitial')) {
    function getUserInitial()
    {
     $user = auth()->user();
   if ($user) {  
     $name = $user->name;
    $initials = [];

        $nameParts = explode(' ', trim($name));
        $firstName = array_shift($nameParts);
        $lastName = array_pop($nameParts);
        $initials[$name] = (
            mb_substr($firstName,0,1) .
            mb_substr($lastName,0,1)
        );

     $initials = implode('', $initials);
     return $initials;
        } else {
            return redirect('login');
        }
    }
}

// Get user's name
if (!function_exists('getUserName')) {
    function getUserName()
    {
     $user = auth()->user();
   if ($user) {  
     $name = $user->name;
     return $name;
        } else {
            return redirect('login');
        }
    }
}

// Get user's firstname
if (!function_exists('getUserFisrtName')) {
    function getUserFisrtName()
    {
     $user = auth()->user();
     $name = $user->name;
     $nameParts = explode(" ", $name);
     $firstName = $nameParts[0];
     return $firstName;
    }
}

// Make ID Characters
if (!function_exists('makeIdNumber')) {
        function makeIdNumber($sn, $numberOfZeros) {
            $idStr = str_pad($sn, $numberOfZeros, "0", STR_PAD_LEFT);
            return $idStr;
        }    
}

// Format amount
if (!function_exists('formatAmount')) {
        function formatAmount($amt) {
            $amt = number_format($amt, 2, '.', ',');
            return $amt;
        }
}

// Sanitize amount
if (!function_exists('sanitizeAmount')) {
        function sanitizeAmount($amt) {
        $amt = filter_var($amt, FILTER_SANITIZE_NUMBER_INT);
        $amt = intval($amt);
        return $amt;
    }
}

// Format Date
if (!function_exists('formatDate')) {
        function formatDate($date) {
          $date = \Carbon\Carbon::parse($date);
          $date = $date->format('j M, Y');
        return $date;
    }
}




/**
 * Get list of records
 */

// Get list of unverified donation records
// -----------------------------------------
if (!function_exists('getUnverifiedDonations')) {
    function getUnverifiedDonations()
    {
    $allRecords = App\Models\InstantRecord::orderBy('updated_at', 'DESC')->get();
     $unverifiedDonations = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 0);
     return $unverifiedDonations;
    }
}

// Get list of donors
// -----------------------------------------
if (!function_exists('getRegisteredDonors')) {
    function getRegisteredDonors()
    {
    $donors = App\Models\Donor::orderBy('updated_at', 'DESC')->get();
    $donors = $donors->where('status', '=', 1);
     return $donors;
    }
}

// Get list of unpaid donation records
// -----------------------------------------
if (!function_exists('getUnpaidDonations')) {
    function getUnpaidDonations()
    {
    $allRecords = App\Models\InstantRecord::all();
     $unpaidDonations = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 0)
                           ->where('verification', '=', 0);
     return $unpaidDonations;
    }
}



/**
 * Record summations (Totals)
 */

// --- Admin ---
// Get instant unverified payment total
// -----------------------------------------
if (!function_exists('sumUnverifiedInsDonations')) {
    function sumUnverifiedInsDonations()
    {
    $allRecords = App\Models\InstantRecord::orderBy('updated_at', 'DESC')->get();
     $totalUnverified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 0);             
// Sum Amount
        $totalUnverified = $totalUnverified->sum('amount');
// Format Amount
        $amt = $totalUnverified;
        $totalUnverified = formatAmount($amt);
     return $totalUnverified;

    }
}

// Get registered unverified payment total
// -----------------------------------------
if (!function_exists('sumUnverifiedRegDonations')) {
    function sumUnverifiedRegDonations()
    {
    $allRecords = App\Models\RegisteredRecord::orderBy('updated_at', 'DESC')->get();
     $totalVerified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 0);             
// Sum Amount
        $totalVerified = $totalVerified->sum('amount');
// Format Amount
        $amt = $totalVerified;
        $totalVerified = formatAmount($amt);
     return $totalVerified;

    }
}

// Get instant verified payment total
// -----------------------------------------
if (!function_exists('sumVerifiedInsDonations')) {
    function sumVerifiedInsDonations()
    {
    $allRecords = App\Models\InstantRecord::orderBy('updated_at', 'DESC')->get();
     $totalVerified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 1);             
// Sum Amount
        $totalVerified = $totalVerified->sum('amount');
// Format Amount
        $amt = $totalVerified;
        $totalVerified = formatAmount($amt);
     return $totalVerified;

    }
}

// Get registered verified payment total
// -----------------------------------------
if (!function_exists('sumVerifiedRegDonations')) {
    function sumVerifiedRegDonations()
    {
    $allRecords = App\Models\RegisteredRecord::orderBy('updated_at', 'DESC')->get();
     $totalVerified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', '1');             
// Sum Amount
        $totalVerified = $totalVerified->sum('amount');
// Format Amount
        $amt = $totalVerified;
        $totalVerified = formatAmount($amt);
     return $totalVerified;

    }
}


// Get the total of all instant donation excluding pledges
// -----------------------------------------
if (!function_exists('sumAllPaidInstantDonations')) {
    function sumAllPaidInstantDonations()
    {
    $allRecords = App\Models\InstantRecord::all();
     $totalPaidInsDonation = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1);
// Sanitize Amount
        // $amt =  $totalInsDonation;
        // $totalInsDonation = sanitizeAmount($amt);  
// Sum Amount
        $totalPaidInsDonation = $totalPaidInsDonation->sum('amount');
// Format Amount
        $amt = $totalPaidInsDonation;
        $totalPaidInsDonation = formatAmount($amt);
     return $totalPaidInsDonation;

    }
}

// Get the total of all registered donation excluding pledges
// -----------------------------------------
if (!function_exists('sumAllPaidRegDonations')) {
    function sumAllPaidRegDonations()
    {
    $allRecords = App\Models\RegisteredRecord::all();
     $totalRegDonation = $allRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 1);
// Sanitize Amount
        // $amt =  $totalRegDonation;
        // $totalRegDonation = sanitizeAmount($amt);  
// Sum Amount
        $totalRegDonation = $totalRegDonation->sum('amount');
// Format Amount
        $amt = $totalRegDonation;
        $totalRegDonation = formatAmount($amt);
        // echo $totalRegDonation;
        // exit();
     return $totalRegDonation;

    }
}

// Sum instant and registered donation excluding pledges 
// -----------------------------------------
if (!function_exists('sumTotalPaidDonation')) {
    function sumTotalPaidDonation()
    {
    $allRegRecords = App\Models\RegisteredRecord::all();
     $allPaidRegRecords = $allRegRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 1);
// Sum Amount
        $totalPaidRegDonation = $allPaidRegRecords->sum('amount');

    $allInsRecords = App\Models\InstantRecord::all();
     $allPaidInsDonation = $allInsRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1);
// Sum Amount
        $totalPaidInsDonation = $allPaidInsDonation->sum('amount');

    $totalPaidDonations = $totalPaidRegDonation + $totalPaidInsDonation;
// Format Amount
        $amt = $totalPaidDonations;
        $totalPaidDonations = formatAmount($amt);
     return $totalPaidDonations;
    }
}

// Sum registered donation for event excluding pledges 
// -----------------------------------------
if (!function_exists('sumTotalPaidEventDonation')) {
    function sumTotalPaidEventDonation()
    {
    $data = App\Models\RegisteredRecord::all();
     $data = $data->where('year', '=', getCurrentYear())
                        ->where('event_id', '=', getCurrentEvent())
                        ->where('payment_status', '=', 1);
// Sum Amount
        $totalPaidEventDonations = $data->sum('amount');

    // $allInsRecords = App\Models\InstantRecord::all();
    //  $allPaidInsDonation = $allInsRecords->where('year', '=', getCurrentYear())
    //                        ->where('transaction', '=', 1)
    //                        ->where('payment_status', '=', 1);
// Sum Amount
        // $totalPaidEventDonation = $totalPaidEventDonation->sum('amount');

    // $totalPaidDonations = $totalPaidRegDonation + $totalPaidInsDonation;
// Format Amount
        $amt = $totalPaidEventDonations;
        $totalPaidEventDonations = formatAmount($amt);
     return $totalPaidEventDonations;
    }
}
// Sum registered donation for current event excluding pledges for recorders
// -----------------------------------------
if (!function_exists('sumTotalPaidEventDonationFR')) {
    function sumTotalPaidEventDonationFR()
    {
    $data = App\Models\RegisteredRecord::all();
     $data = $data->where('year', '=', getCurrentYear())
                        ->where('event_id', '=', getCurrentEvent())
                        ->where('payment_status', '=', 1)
                        ->where('recorder_id', '=', getCurrentUser());
// Sum Amount
        $totalPaidEventDonationFR = $data->sum('amount');
// Format Amount
        $amt = $totalPaidEventDonationFR;
        $totalPaidEventDonationFR = formatAmount($amt);
     return $totalPaidEventDonationFR;
    }
}
// Sum instant donation excluding pledges for recorders
// -----------------------------------------
if (!function_exists('sumTotalPaidInsDonationFR')) {
    function sumTotalPaidInsDonationFR()
    {
    $data = App\Models\InstantRecord::all();
     $data = $data->where('year', '=', getCurrentYear())
                        ->where('payment_status', '=', 1)
                        ->where('recorder_id', '=', getCurrentUser());
// Sum Amount
        $totalPaidInsDonations = $data->sum('amount');
// Format Amount
        $amt = $totalPaidInsDonations;
        $totalPaidInsDonations = formatAmount($amt);
     return $totalPaidInsDonations;
    }
}

// Get the total of available fund for ins donation
// -----------------------------------------
if (!function_exists('sumInsAvailableFund')) {
    function sumInsAvailableFund()
    {
    $allInsRecords = App\Models\InstantRecord::all();
     $availableInsFund = $allInsRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 1);

// Sum Amount
        $availableInsFund = $availableInsFund->sum('amount');
        $sumAvailableInsFund = $availableInsFund - sumOfAllExpenses();
// Format Amount
        $amt = $sumAvailableInsFund;
        $sumAvailableInsFund = formatAmount($amt);
     return $sumAvailableInsFund;

    }
}

// Get the total of available fund for reg donation
// -----------------------------------------
if (!function_exists('sumAvailableFund')) {
    function sumAvailableFund()
    {
    $allInsRecords = App\Models\InstantRecord::all();
    $availableInsFund = $allInsRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 1);
// Sum Amount
    $totalAvailableInsFund = $availableInsFund->sum('amount');

    $allRegRecords = App\Models\RegisteredRecord::all();
    $availableRegFund = $allRegRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 1);

// Sum Amount
    $totalAvailableRegFund = $availableRegFund->sum('amount');

    $totalAvailableFund = $totalAvailableInsFund + $totalAvailableRegFund;    

// Format Amount
        $amt = $totalAvailableFund;
        $totalAvailableFund = formatAmount($amt);
     return $totalAvailableFund;

    }
}

// Get the total of available fund for event donations
// -----------------------------------------
if (!function_exists('sumAvailableEventFund')) {
    function sumAvailableEventFund()
    {
//     $allInsRecords = App\Models\InstantRecord::all();
//     $availableInsFund = $allInsRecords->where('year', '=', getCurrentYear())
//                            ->where('transaction', '=', 1)
//                            ->where('payment_status', '=', 1)
//                            ->where('verification', '=', 1);
// // Sum Amount
    // $totalAvailableInsFund = $availableInsFund->sum('amount');

    $data = App\Models\RegisteredRecord::all();
    $data = $data->where('year', '=', getCurrentYear())
                        ->where('event_id', '=', getCurrentEvent())
                        ->where('payment_status', '=', 1)
                        ->where('verification', '=', 1);

// Sum Amount
    $totalAvailableEventFund = $data->sum('amount');

// $totalAvailableFund = $totalAvailableInsFund + $totalAvailableRegFund;    

// Format Amount
        $amt = $totalAvailableEventFund;
        $totalAvailableEventFund = formatAmount($amt);
     return $totalAvailableEventFund;

    }
}

// Get the total of all expenses
// -----------------------------------------
if (!function_exists('sumOfAllExpenses')) {
    function sumOfAllExpenses()
    {
    $allRecords = App\Models\InstantRecord::all();
     $sumOfAllExpenses = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 0);

// Sum Amount
        $sumOfAllExpenses = $sumOfAllExpenses->sum('amount');
// Format Amount
        // $amt = $sumOfAllExpenses;
        // $sumOfAllExpenses = formatAmount($amt);
     return $sumOfAllExpenses;

    }
}

// Get the total of all instant donation including pledges
// -----------------------------------------
if (!function_exists('sumAllInstantDonationsWithPledges')) {
    function sumAllInstantDonationsWithPledges()
    {
    $allRecords = App\Models\InstantRecord::all();
     $sumAllInstantDonationsWithPledges = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1);
// Sum Amount
        $sumAllInstantDonationsWithPledges = $sumAllInstantDonationsWithPledges->sum('amount');
// Format Amount
        $amt = $sumAllInstantDonationsWithPledges;
        $sumAllInstantDonationsWithPledges = formatAmount($amt);
     return $sumAllInstantDonationsWithPledges;

    }
}

// Get the total of all registered donation including pledges
// -----------------------------------------
if (!function_exists('sumAllRegDonationsWithPledges')) {
    function sumAllRegDonationsWithPledges()
    {
    $allRegRecords = App\Models\RegisteredRecord::all();
    $allRegDonationsWithPledges = $allRegRecords->where('year', '=', getCurrentYear());
// Sum Amount
        $totalRegDonationsWithPledges = $allRegDonationsWithPledges->sum('amount');
// Format Amount
        $amt = $totalRegDonationsWithPledges;
        $totalRegDonationsWithPledges = formatAmount($amt);
     return $totalRegDonationsWithPledges;

    }
}

// Get the total of all donation including pledges
// -----------------------------------------
if (!function_exists('sumAllDonationsWithPledges')) {
    function sumAllDonationsWithPledges()
    {
    $allInsRecords = App\Models\InstantRecord::all();
    $allInsDonationsWithPledges = $allInsRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1);
    $allRegRecords = App\Models\RegisteredRecord::all();
    $allRegDonationsWithPledges = $allRegRecords->where('year', '=', getCurrentYear());
// Sum Amount
        $allInsDonationsWithPledges = $allInsDonationsWithPledges->sum('amount');
        $allRegDonationsWithPledges = $allRegDonationsWithPledges->sum('amount');

        $totalDonationsWithPledges = $allInsDonationsWithPledges + $allRegDonationsWithPledges;
// Format Amount
        $amt = $totalDonationsWithPledges;
        $totalDonationsWithPledges = formatAmount($amt);
     return $totalDonationsWithPledges;

    }
}

// Get the total of all event donation including pledges
// -----------------------------------------
if (!function_exists('sumAllEventDonationsWithPledges')) {
    function sumAllEventDonationsWithPledges()
    {
    // $data = App\Models\InstantRecord::all();
    // $allInsDonationsWithPledges = $allInsRecords->where('year', '=', getCurrentYear())
    //                        ->where('transaction', '=', 1);
    $data = App\Models\RegisteredRecord::all();
    $data = $data->where('year', '=', getCurrentYear())->where('event_id', '=', getCurrentEvent());
// Sum Amount
        // $allInsDonationsWithPledges = $allInsDonationsWithPledges->sum('amount');
        $allEventDonationsWithPledges = $data->sum('amount');

        // $totalDonationsWithPledges = $allInsDonationsWithPledges + $allRegDonationsWithPledges;
// Format Amount
        $amt = $allEventDonationsWithPledges;
        $totalEventDonationsWithPledges = formatAmount($amt);
     return $totalEventDonationsWithPledges;

    }
}


// Get the total of all instant pledges
// -----------------------------------------
if (!function_exists('sumAllInstantPledges')) {
    function sumAllInstantPledges()
    {
    $allRecords = App\Models\InstantRecord::all();
     $sumAllInstantPledges = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 0)
                           ->where('verification', '=', 0);
// Sum Amount
        $sumAllInstantPledges = $sumAllInstantPledges->sum('amount');
// Format Amount
        $amt = $sumAllInstantPledges;
        $sumAllInstantPledges = formatAmount($amt);
     return $sumAllInstantPledges;

    }
}

// Get all records
// -----------------------------------------
if (!function_exists('getAllRecords')) {
    function getAllRecords()
    {
        $instantRecords = App\Models\InstantRecord::select('id', 'recorder_id', 'name', 'purpose', 'amount', 'payment_mode', 'transaction', 'verification', 'payment_status', 'phone', 'updated_at')->where('year', '=', getCurrentYear())->get();
        $registeredDonations = App\Models\RegisteredRecord::join('donors', 'registered_records.donor_id', '=', 'donors.id')->select('registered_records.id', 'registered_records.recorder_id', 'donors.name', 'registered_records.purpose', 'registered_records.amount', 'registered_records.payment_mode', 'registered_records.payment_status', 'registered_records.verification', 'donors.phone', 'registered_records.updated_at')->where('year', '=', getCurrentYear())->get();

        $allRecords = $instantRecords->concat($registeredDonations)->sortByDesc('updated_at')->take(10);

     return $allRecords;

    }
}

// Get the total of all registered pledges
// -----------------------------------------
if (!function_exists('sumAllRegPledges')) {
    function sumAllRegPledges()
    {
    $allRegRecords = App\Models\RegisteredRecord::all();
     $allRegPledges = $allRegRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 0)
                           ->where('verification', '=', 0);
// Sum Amount
        $sumAllRegPledges = $allRegPledges->sum('amount');
// Format Amount
        $amt = $sumAllRegPledges;
        $totalRegPledges = formatAmount($amt);
     return $totalRegPledges;

    }
}

// Get the total of all pledges
// -----------------------------------------
if (!function_exists('sumAllPledges')) {
    function sumAllPledges()
    {
    $allInsRecords = App\Models\InstantRecord::all();
    $sumAllInsPledges = $allInsRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 0)
                           ->where('verification', '=', 0);
    $allRegRecords = App\Models\RegisteredRecord::all();
    $sumAllRegPledges = $allRegRecords->where('year', '=', getCurrentYear())
                           ->where('payment_status', '=', 0)
                           ->where('verification', '=', 0);
// Sum Amount
        $totalInsPledges = $sumAllInsPledges->sum('amount');
        $totalRegPledges = $sumAllRegPledges->sum('amount');
        $totalPledges = $totalInsPledges + $totalRegPledges;
// Format Amount
        $amt = $totalPledges;
        $totalPledges = formatAmount($amt);
     return $totalPledges;

    }
}

// Get the total of event pledges
// -----------------------------------------
if (!function_exists('sumAllEventPledges')) {
    function sumAllEventPledges()
    {
    // $allInsRecords = App\Models\InstantRecord::all();
    // $sumAllInsPledges = $allInsRecords->where('year', '=', getCurrentYear())
    //                        ->where('transaction', '=', 1)
    //                        ->where('payment_status', '=', 0)
    //                        ->where('verification', '=', 0);
    $data = App\Models\RegisteredRecord::all();
    $data = $data->where('year', '=', getCurrentYear())
                    ->where('event_id', '=', getCurrentEvent())
                    ->where('payment_status', '=', 0)
                    ->where('verification', '=', 0);
// Sum Amount
        // $totalInsPledges = $sumAllInsPledges->sum('amount');
        $totalEventPledges = $data->sum('amount');
        // $totalPledges = $totalEventPledges;
// Format Amount
        $amt = $totalEventPledges;
        $totalEventPledges = formatAmount($amt);
     return $totalEventPledges;

    }
}

// Get the total of event pledges for recorders
// -----------------------------------------
if (!function_exists('sumAllEventPledgesFR')) {
    function sumAllEventPledgesFR()
    {
    $data = App\Models\RegisteredRecord::all();
    $data = $data->where('year', '=', getCurrentYear())
                 ->where('event_id', '=', getCurrentEvent())
                 ->where('payment_status', '=', 0)
                 ->where('verification', '=', 0)
                 ->where('recorder_id', '=', getCurrentUser());
    // $totalEventPledges = $data;
        $totalEventPledges = $data->sum('amount');
    // Format Amount
        $amt = $totalEventPledges;
        $totalEventPledges = formatAmount($amt);
     return $totalEventPledges;

    }
}

// Get the total of instant pledges for recorders
// -----------------------------------------
if (!function_exists('sumAllInsPledgesFR')) {
    function sumAllInsPledgesFR()
    {
    $data = App\Models\InstantRecord::all();
    $data = $data->where('year', '=', getCurrentYear())
                 ->where('payment_status', '=', 0)
                 ->where('verification', '=', 0)
                 ->where('recorder_id', '=', getCurrentUser());
    // $totalInsPledges = $data;
        $totalInsPledges = $data->sum('amount');
    // Format Amount
        $amt = $totalInsPledges;
        $totalInsPledges = formatAmount($amt);
     return $totalInsPledges;

    }
}




// --- Recorder ---

// Get unverified payment total
// -----------------------------------------
if (!function_exists('sumUnverifiedDonationsForRecorder')) {
    function sumUnverifiedDonationsForRecorder()
    {
    $allRecords = App\Models\InstantRecord::all();
     $totalUnverified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', '0')
                           ->where('recorder_id', '=', getCurrentUser());
// Sum Amount
        $totalUnverified = $totalUnverified->sum('amount');
// Format Amount
        $amt = $totalUnverified;
        $totalUnverified = formatAmount($amt);
     return $totalUnverified;

    }
}

// Get the total of all donation excluding pledges
// -----------------------------------------
if (!function_exists('sumAllInstantDonationsFR')) {
    function sumAllInstantDonationsFR()
    {
    $allRecords = App\Models\InstantRecord::all();
     $sumAllInstantDonationsFR = $allRecords->where('year', '=', getCurrentYear())
                           ->where('event_id', '=', getCurrentEvent())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('recorder_id', '=', getCurrentUser());
// Sum Amount
        $sumAllInstantDonationsFR = $sumAllInstantDonationsFR->sum('amount');
// Format Amount
        $amt = $sumAllInstantDonationsFR;
        $sumAllInstantDonationsFR = formatAmount($amt);
     return $sumAllInstantDonationsFR;

    }
}

// Get the total of all pledges
// -----------------------------------------
if (!function_exists('sumAllInstantPledgesFR')) {
    function sumAllInstantPledgesFR()
    {
    $allRecords = App\Models\InstantRecord::all();
     $sumAllInstantPledgesFR = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('verification', '=', 0)
                           ->where('payment_status', '=', 0)
                           ->where('recorder_id', '=', getCurrentUser());
// Sum Amount
        $sumAllInstantPledgesFR = $sumAllInstantPledgesFR->sum('amount');
// Format Amount
        $amt = $sumAllInstantPledgesFR;
        $sumAllInstantPledgesFR = formatAmount($amt);
     return $sumAllInstantPledgesFR;

    }
}

// Check the donation display settings
// -----------------------------------------
if (!function_exists('checkDonationDisplay')) {
    function checkDonationDisplay()
    {
    $donationDisplay = App\Models\Setting::get()->where('id', '=', 1);

     return $donationDisplay;

    }
}
