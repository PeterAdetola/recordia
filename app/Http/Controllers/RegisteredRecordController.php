<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\RegisteredRecord;
use App\Models\User;

class RegisteredRecordController extends Controller
{


    /**
     * Get all registered records.
     */
    public function getAllRegisteredRecords(RegisteredRecord $registeredRecord)
    {

        $registeredRecords = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear());

        return view('admin.records.registered.registered_records', compact('registeredRecords'));
    }

    /**
     * Save donation.
     */
    public function saveRegDonation(Request $request)
    {
        $request->validate([
            'donor_id' => 'required',            
            'amount' => 'required',
            'purpose' => 'required',
            'slip_no' => 'required',
            'payment_mode' => 'required',
        ],[
            'donor_id.required' => 'Donor\'fullname and title is required',
            'amount.required' => 'Amount donated is required',
            'purpose.required' => 'Purpose of donation is required',
            'slip_no.required' => 'Slip number is required',
            'payment_mode.required' => 'Indicate the mode of payment',
        ]);


    /**
     * Cash     (payment_mode = 1)
     * POS      (payment_mode = 2)
     * Transfer (payment_mode = 3)
     * Pledge   (payment_mode = 4)
     */
// Get Event
    $request->recorder_id = getCurrentUser();
    $request->event_id = getCurrentEvent();
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
            'event_id' => $request->event_id,
            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'Donation saved'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Update resource in storage.
     */
    public function updateDonation(Request $request)
    {
        $id = $request->id;

        if (!isset($request->payment_status)){
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

        RegisteredRecord::findOrFail($id)->update([
        'purpose' => $request->purpose,
        'amount' => $amount,
        'payment_status' => $request->payment_status,
        'verification' => $request->verification,
    ]);

        $notification = array(
            'message' => 'Donation Updated'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Redeem Donor's Donation.
     */
    public function redeemDonorDonation(Request $request)
    {
        $id = $request->id;

        if (!isset($request->verification)){
            $request->verification = 0;
        }

        RegisteredRecord::findOrFail($id)->update([
        'verification' => $request->verification,
        'payment_status' => $request->payment_status,
    ]);

        $notification = array(
            'message' => 'Pledge redeemed'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Get all registered verified donation.
     */
    public function getVerifiedDonations(RegisteredRecord $registeredRecord)
    {

        $verifiedDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 1);

        return view('admin.records.registered.paid.verified_donations', compact('verifiedDonations'));
    }

    /**
     * verified a donation.
     */
    public function verifyADonation(Request $request)
    {

        $id = $request->id;

        $request->verification = 1;

        RegisteredRecord::findOrFail($id)->update([
        'verification' => $request->verification,
    ]);

        $notification = array(
            'message' => 'Payment verified'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * unverified a donation.
     */
    public function unverifyADonation(Request $request)
    {

        $id = $request->id;

        $request->verification = 0;

        RegisteredRecord::findOrFail($id)->update([
        'verification' => $request->verification,
    ]);

        $notification = array(
            'message' => 'Payment unverified'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Preview all registered verified donation.
     */
    public function prevVerifiedDonations(RegisteredRecord $registeredRecord)
    {

        $verifiedDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 1);

        return view('admin.records.registered.paid.prev_verified_donations', compact('verifiedDonations'));
    }


    /**
     * Get all registered unverified donation.
     */
    public function getUnverifiedDonations(RegisteredRecord $registeredRecord)
    {

        $unverifiedDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 0);
        // $recorder = User::all();

        return view('admin.records.registered.paid.unverified_donations', compact('unverifiedDonations'));
    }

    /**
     * Preview all registered unverified donation.
     */
    public function prevUnverifiedDonations(RegisteredRecord $registeredRecord)
    {

        $unverifiedDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 1)
                                        ->where('verification', '=', 0);

        return view('admin.records.registered.paid.prev_unverified_donations', compact('unverifiedDonations'));
    }

    /**
     * Get all registered unpaid donation.
     */
    public function getUnpaidDonations(RegisteredRecord $registeredRecord)
    {

        $unpaidDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 0);

        return view('admin.records.registered.unpaid.unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Preview registered unpaid donation.
     */
    public function prevUnpaidDonations(RegisteredRecord $registeredRecord)
    {

        $unpaidDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 0);

        return view('admin.records.registered.unpaid.prev_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Edit registered unpaid donations.
     */
    public function editPledges(Request $request)
    {
        $unpaidDonations = RegisteredRecord::orderBy('updated_at', 'DESC')->get()
                                        ->where('year', '=', getCurrentYear())
                                        ->where('payment_status', '=', 0);

        return view('admin.records.registered.unpaid.edit_unpaid_donations', compact('unpaidDonations'));
    }
}
