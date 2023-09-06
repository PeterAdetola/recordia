<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;

class InstantRecordController extends Controller
{
    

    /**
     * Save a newly created donation in storage.
     */
    public function saveDonation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'purpose' => 'required',
            'transaction' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
            'phone' => 'required_if:payment_status, Unpaid',
        ],[
            'name.required' => 'Donor\'fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
            'payment_mode.required' => 'Indicate the mode of payment',
            'phone.required' => 'Phone number of a pledging donor is required',
        ]);


    /**
     * Cash     (payment_mode = 1)
     * POS      (payment_mode = 2)
     * Transfer (payment_mode = 3)
     * Pledge   (payment_mode = 4)
     */

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


      InstantRecord::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $request->amount,
            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status,
            'verification' => $request->verified,
            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'Donation added'
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
