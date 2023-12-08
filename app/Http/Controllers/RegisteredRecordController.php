<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\RegisteredRecord;
use App\Models\User;

class RegisteredRecordController extends Controller
{

    /**
     * Save donation.
     */
    public function saveDonation(Request $request)
    {
        // $request->validate([
        //     'donor_id' => 'required',            
        //     'amount' => 'required',
        //     'purpose' => 'required',
        //     'slip_no' => 'required',
        //     'payment_mode' => 'required',
        // ],[
        //     'donor_id.required' => 'Donor\'fullname and title is required',
        //     'amount.required' => 'Amount donated is required',
        //     'purpose.required' => 'Purpose of donation is required',
        //     'slip_no.required' => 'Slip number is required',
        //     'payment_mode.required' => 'Indicate the mode of payment',
        // ]);


    /**
     * Cash     (payment_mode = 1)
     * POS      (payment_mode = 2)
     * Transfer (payment_mode = 3)
     * Pledge   (payment_mode = 4)
     */
// Get Event
    $request->recorder_id = getCurrentUser();
    $request->event = getCurrentEvent();
    $request->year = getCurrentYear();

        switch ($request->payment_mode) {
    case ($request->payment_mode == 1):        
            $request->verification = 1;
            $request->payment_status = 1;
        break;
    case ($request->payment_mode == 2):        
            $request->verification = 1;
            $request->payment_status = 1;
        break;
    case ($request->payment_mode == 3):        
            $request->verification = 0;
            $request->payment_status = 1;
        break;
    case ($request->payment_mode == 4):        
            $request->verification = 0;
            $request->payment_status = 0;
        break;
    default:        
            $request->verification = 0;
            $request->payment_status = 0;
        }

        // Sanitize amount to numbers only
        $amount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
        $amount = intval($amount);

      RegisteredRecord::create([
            'donor_id' => $request->donor_id,
            'recorder_id' => $request->recorder_id,
            'amount' => $amount,
            'purpose' => $request->purpose,
            'slip_no' => $request->slip_no,
            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status,
            'verification' => $request->verification,
            'event' => $request->event,
            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'Donation saved'
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
