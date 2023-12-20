<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\RegisteredRecord;
use App\Models\User;

class AllRecordController extends Controller
{

    /**
     * Get all records.
     */
    public function getAllRecords(Request $request)
    {

        $instantRecords = InstantRecord::select('id', 'recorder_id', 'donor_name', 'purpose', 'amount', 'payment_mode', 'updated_at')->get();
        $registeredDonations = RegisteredRecord::join('donor', 'registered_records.donor_id', '=', 'donor.id')->select('registered_records.id', 'registered_records.recorder_id', 'donor.donor_name', 'registered_records.purpose', 'registered_records.amount', 'registered_records.updated_at')->get();

        $allRecords = $instantRecords->concat($registeredDonations)->sortByDesc('updated_at');

    }
}
