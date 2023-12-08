<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\RegisteredRecord;
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
// Get Event
    $request->event = getCurrentEvent();

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
            'event' => $request->event,
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
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 0);

        return view('admin.records.unpaid.unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Get all instant verified donation.
     */
    public function getVerifiedDonations(InstantRecord $instantRecord)
    {

        $verifiedDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 1);

        return view('admin.records.paid.verified_donations', compact('verifiedDonations'));
    }

    /**
     * Get all instant unverified donation.
     */
    public function getUnverifiedDonations(InstantRecord $instantRecord)
    {

        $unverifiedDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 0);
        $recorder = User::all();

        return view('admin.records.paid.unverified_donations', compact('unverifiedDonations'), compact('recorder'));
    }

    /**
     * Get all expenses.
     */
    public function getExpenses(InstantRecord $instantRecord)
    {

        $expenses = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 0);

        return view('admin.records.expenses.expenses', compact('expenses'));
    }

    // -----------------|Edit pledges|-----------------------
    public function editPledges(Request $request)
    {
        $unpaidDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 0);

        return view('admin.records.unpaid.edit_unpaid_donations', compact('unpaidDonations'));
    }

    // -----------------|Redeem a pledge|-----------------------
    public function redeemAPledge(Request $request)
    {
        // $formData = $request->get('id');
        // echo $formData;
        // exit();
        $id = $request->id;

        InstantRecord::findOrFail($id)->update([
        'payment_status' => $request->payment_status,
    ]);

        $notification = array(
            'message' => 'Pledge redeemed'
        );

        return redirect()->route('instant.unpaid.donations')->with($notification);
    }

    // -----------------|Verify a payment|-----------------------
    public function verifyADonation(Request $request)
    {

        $id = $request->id;

        InstantRecord::findOrFail($id)->update([
        'verification' => $request->verification,
    ]);

        $notification = array(
            'message' => 'Payment verified'
        );

        return redirect()->back()->with($notification);
    }

    // -----------------|Redeem list of pledges|-----------------------
    public function redeemPledges(Request $request)
    {

        $redeemPledges = $request->input('payment_status', []);

        foreach ($redeemPledges as $redeemPledge) {

                $request->payment_status = 1;
                $request->verification = 1;
                InstantRecord::findOrFail($redeemPledge)->update([
                'payment_status' => $request->payment_status,
                'verification' => $request->verification,
                    ]);
                }

        $notification = array(
            'message' => 'Plegdes redeemed'
        );

        return redirect()->route('instant.edit.pledges')->with($notification);
    }

    // -----------------|Preview Unpaid Donations|-----------------------
    public function prevUnpaidDonations(InstantRecord $instantRecord)
    {

        $unpaidDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 0);

        return view('admin.records.unpaid.prev_unpaid_donations', compact('unpaidDonations'));
    }

    // -----------------|Preview Verified Donations|-----------------------
    public function prevVerifiedDonations(InstantRecord $instantRecord)
    {

        $verifiedDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 1);

        return view('admin.records.paid.prev_verified_donations', compact('verifiedDonations'));
    }

    // -----------------|Preview Unverified Donations|-----------------------
    public function prevUnverifiedDonations(InstantRecord $instantRecord)
    {

        $unverifiedDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 1)
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 0);

        return view('admin.records.paid.prev_unverified_donations', compact('unverifiedDonations'));
    }

    // -----------------|Preview Expenses|-----------------------
    public function prevExpenses(InstantRecord $instantRecord)
    {

        $expenses = InstantRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('transaction', '=', 0)
                                        ->where('payment_status', '=', 0)
                                        ->where('verification', '=', 0);

        return view('admin.records.expenses.prev_expenses', compact('expenses'));
    }

    /**
     * Update resource in storage.
     */
    public function updateTransaction(Request $request)
    {
        $id = $request->id;

        if (!isset($request->payment_status) && ($request->transaction == 1)){
            $request->payment_mode = 4;
            $request->payment_status = 0;
            $request->verification = 0;
        }

        if (!isset($request->verification)){
            $request->verification = 0;
        }

        if ($request->payment_status == ''){
            $request->payment_status = 0;
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

        return redirect()->back()->with($notification);
    }

}
