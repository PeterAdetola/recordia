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

// Format Amount
// if (!function_exists('formatAmount')) {
//     function formatAmount($amount)
//     {
//         $totalUnverified = number_format($amount, 2, '.', ',');
//      return $name;
//     }
// }

// UNVERIFIED DONATION

// Get unverified donation records
if (!function_exists('getUnverifiedDonations')) {
    function getUnverifiedDonations()
    {
    $allRecords = App\Models\InstantRecord::all();
     $unverifiedDonations = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', '0');
     return $unverifiedDonations;
    }
}


// Get unverified payment total (for Admin)
if (!function_exists('sumUnverifiedDonations')) {
    function sumUnverifiedDonations()
    {
    $allRecords = App\Models\InstantRecord::all();
     $totalUnverified = $allRecords->where('year', '=', getCurrentYear())
                           ->where('transaction', '=', 1)
                           ->where('payment_status', '=', 1)
                           ->where('verification', '=', '0');
// Sum Amount
        $totalUnverified_r = $totalUnverified->sum('amount');
// Format Amount
        $totalUnverified = number_format($totalUnverified_r, 2, '.', ',');
     return $totalUnverified;

    }
}

// Get unverified payment total (for Recorder)
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
        $totalUnverified_r = $totalUnverified->sum('amount');
// Format Amount
        $totalUnverified = number_format($totalUnverified_r, 2, '.', ',');
     return $totalUnverified;

    }
}
