<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\User;

class InstantRecordController extends Controller
{
    

    /**
     * Save donation.
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
            'recorder_id' => $request->recorder_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $request->amount,
            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status,
            'verification' => $request->verification,
            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'Donation saved'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Save expense.
     */
    public function saveExpense(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'purpose' => 'required',
            'transaction' => 'required',
            'amount' => 'required',
        ],[
            'name.required' => 'Donor\'fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
        ]);

        $request->payment_status = 0;
        $request->payment_mode = 0;
        $request->verification = 0;

      InstantRecord::create([
            'recorder_id' => $request->recorder_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $request->amount,

            'payment_mode' => $request->payment_mode,
            'payment_status' => $request->payment_status,
            'verification' => $request->verification,

            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'Expense saved'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Verify unverified donations.
     */
    public function verifyDonation(Request $request)
    {

        $verifications = $request->input('verification', []);

        foreach ($verifications as $verification) {

            // Collect checked ids
            $verify_id = $request->verification;
            // Set the check ids to 1
                $request->verification = 1;
                InstantRecord::findOrFail($verification)->update([
                'verification' => $request->verification,
            ]);
                }

        $notification = array(
            'message' => 'Verification done'
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
