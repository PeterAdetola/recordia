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

        // Sanitize amount to numbers only
        $amount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
        $amount = intval($amount);

      InstantRecord::create([
            'recorder_id' => $request->recorder_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $amount,
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

        // Sanitize amount to numbers only
        $amount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_INT);
        $amount = intval($amount);

      InstantRecord::create([
            'recorder_id' => $request->recorder_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $amount,

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

    /**
     * Redeem pledges.
     */
    public function redeemPledges(Request $request)
    {

        $redeemPledges = $request->input('payment_status', []);

        foreach ($redeemPledges as $redeemPledge) {

                $request->payment_status = 1;
                InstantRecord::findOrFail($redeemPledge)->update([
                'payment_status' => $request->payment_status,
                    ]);
                }

        $notification = array(
            'message' => 'Verification done'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Get all instant records.
     */
    public function getAllInstantRecords(InstantRecord $instantRecord)
    {

        $instantRecords = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear());

        return view('admin.records.instant_records', compact('instantRecords'));
    }

    /**
     * Get all instant unpaid donation.
     */
    public function getUnpaidDonations(InstantRecord $instantRecord)
    {

        $unpaidDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 0)
                                        ->where('payment_mode', '=', 4);

        return view('admin.records.unpaid.unpaid_donations', compact('unpaidDonations'));
    }

    // -----------------|Preview Unpaid Donations|-----------------------
    public function prevUnpaidDonations(InstantRecord $instantRecord)
    {

        $unpaidDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 0)
                                        ->where('payment_mode', '=', 4);

        return view('admin.records.unpaid.prev_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Update resource in storage.
     */
    public function updateTransaction(Request $request)
    {
        $id = $request->id;

        if (!isset($request->payment_status) && ($request->transaction == 1)){
            $request->payment_status = 0;
            $request->payment_mode = 4;
            $request->verification = 0;
        }

        if (!isset($request->verification)){
            $request->verification = 0;
        }

        $amount = str_replace(",", "", $request->amount);
        $amount = str_replace(".", "", $amount);


        $amount = intval($amount);

        // echo $amount;
        // exit;

        InstantRecord::findOrFail($id)->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'purpose' => $request->purpose,
        'transaction' => $request->transaction,
        'amount' => $amount,
        'payment_status' => $request->payment_status,
        'verification' => $request->verification,
    ]);

        $notification = array(
            'message' => 'Transaction Updated'
        );

        return redirect()->route('get.instant.records')->with($notification);
    }

}
