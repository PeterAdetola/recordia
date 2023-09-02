<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstantRecord;
use Illuminate\Support\Str;
// use Illuminate\Support\Carbon;



class InstantRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData = InstantRecord::orderBy('updated_at', 'DESC')->get();

        return view('dashboard', compact('allData'));
    }

    /**
     * Display the all records.
     */
    public function show(InstantRecord $instantRecord)
    {

        $instaRecords = InstantRecord::orderBy('updated_at', 'DESC')->get();

        return view('admin.records.instant_records', compact('instaRecords'));
    }

    /**
     * Display the unverified records.
     */
    public function showUnverified(InstantRecord $instantRecord)
    {

        $instaRecords = InstantRecord::orderBy('updated_at', 'DESC')->get();

        $unverifiedRecords = $instaRecords->where('verified', '=', '0')
                                          ->where('payment_status', '=', 'Paid')
                                          ->where('transaction', '=', 'credit');

        return view('admin.records.unverified_records', compact('unverifiedRecords'));
    }

    /**
     * Preview the unverified records for print.
     */
    public function printUnverified(InstantRecord $instantRecord)
    {

        $instaRecords = InstantRecord::orderBy('updated_at', 'DESC')->get();

        $unverifiedRecords = $instaRecords->where('verified', '=', '0')
                                          ->where('payment_status', '=', 'Paid')
                                          ->where('transaction', '=', 'credit');

        return view('admin.records.preview_unverified', compact('unverifiedRecords'));
    }

    /**
     * Display the verified records.
     */
    public function showVerified(InstantRecord $instantRecord)
    {

        $instaRecords = InstantRecord::orderBy('updated_at', 'DESC')->get();

        $verifiedRecords = $instaRecords->where('verified', '=', '1')
                                          ->where('payment_status', '=', 'Paid')
                                          ->where('transaction', '=', 'credit');

        return view('admin.records.verified_records', compact('verifiedRecords'));
    }

    /**
     * Preview the verified records for print.
     */
    public function printVerified(InstantRecord $instantRecord)
    {

        $instaRecords = InstantRecord::orderBy('updated_at', 'DESC')->get();

        $verifiedRecords = $instaRecords->where('verified', '=', '1')
                                          ->where('payment_status', '=', 'Paid')
                                          ->where('transaction', '=', 'credit');

        return view('admin.records.preview_verified', compact('verifiedRecords'));
    }

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
            'payment_status' => 'required',
            'phone' => 'required_if:payment_status, Unpaid',
        ],[
            'name.required' => 'Donor\'fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
            'payment_status.required' => 'Indicate the status of payment',
            'phone.required' => 'Phone number of a pledging donor is required',
        ]);

        if (!isset($request->verified)){
            $request->verified = 0;
        }


      InstantRecord::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $request->amount,
            'payment_status' => $request->payment_status,
            'verified' => $request->verified,
        ]);

        $notification = array(
            'message' => 'Donation added'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function saveExpense(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'purpose' => 'required',
            'transaction' => 'required',
            'amount' => 'required',
            'payment_status' => 'required',
        ],[
            'name.required' => 'Donor\'fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
            'payment_status.required' => 'Indicate the status of payment',
        ]);

      InstantRecord::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $request->amount,
            'payment_status' => $request->payment_status,
            'verified' => $request->verified,
        ]);

        $notification = array(
            'message' => 'Expense added'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Update resource in storage.
     */
    public function updateTransaction(Request $request)
    {
        $id = $request->id;

        if (!isset($request->payment_status)){
            $request->payment_status = 'Unpaid';
        }

        if (!isset($request->verified)){
            $request->verified = 0;
        }

        $amount = str_replace(",", "", $request->amount);
        // $amount = rtrim($amount, ".00");
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
        'verified' => $request->verified,
    ]);

        $notification = array(
            'message' => 'Transaction Updated'
        );

        return redirect()->route('instantRecords')->with($notification);
    }

    /**
     * Update transaction from index page.
     */
    public function verifyPayment(Request $request)
    {
        $id = $request->id;

        if (!isset($request->verified)){
            $request->verified = 0;
        }


        // echo $amount;
        // exit;

        InstantRecord::findOrFail($id)->update([
        'verified' => $request->verified,
    ]);

        $notification = array(
            'message' => 'Payment verified'
        );

        return redirect()->route('dashboard')->with($notification);
    }

}

