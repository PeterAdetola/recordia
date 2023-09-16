<?php
use Illuminate\Support\Facades\Auth;


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

// Extract initials from user's name
if (!function_exists('getUserInitial')) {
    function getUserInitial()
    {
     $user = auth()->user();
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
    }
}

// Get user's name
if (!function_exists('getUserName')) {
    function getUserName()
    {
     $user = auth()->user();
     $name = $user->name;
     return $name;
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
                           ->where('verification', '=', '0');
     return $unverifiedDonations;
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
// Get unverified payment total
// -----------------------------------------
if (!function_exists('sumUnverifiedDonations')) {
    function sumUnverifiedDonations()
    {
    $allRecords = App\Models\InstantRecord::orderBy('updated_at', 'DESC')->get();
     $totalUnverified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', '0');             
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
if (!function_exists('sumAllInstantDonations')) {
    function sumAllInstantDonations()
    {
    $allRecords = App\Models\InstantRecord::all();
     $totalInsDonation = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1);
// Sanitize Amount
        // $amt =  $totalInsDonation;
        // $totalInsDonation = sanitizeAmount($amt);  
// Sum Amount
        $totalInsDonation = $totalInsDonation->sum('amount');
// Format Amount
        $amt = $totalInsDonation;
        $totalInsDonation = formatAmount($amt);
     return $totalInsDonation;

    }
}

// Get the total of available fund
// -----------------------------------------
if (!function_exists('sumAvailableFund')) {
    function sumAvailableFund()
    {
    $allRecords = App\Models\InstantRecord::all();
     $availableFund = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', 1);

// Sum Amount
        $availableFund = $availableFund->sum('amount');
        $sumAvailableFund = $availableFund - sumOfAllExpenses();
// Format Amount
        $amt = $sumAvailableFund;
        $sumAvailableFund = formatAmount($amt);
     return $sumAvailableFund;

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

// Get the total of all donation including pledges
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


// Get the total of all pledges
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
