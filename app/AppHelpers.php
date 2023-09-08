<?php


if (!function_exists('getCurrentYear')) {
    function getCurrentYear()
    {
     $currentYear = App\Models\YearRecord::where('status', 1)->first();
     
     return $currentYear->year;
    }
}
