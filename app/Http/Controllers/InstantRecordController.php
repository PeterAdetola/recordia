<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstantRecord;
use App\Models\User;

class InstantRecordController extends Controller
{
    
    /**
     * Access.
     */
    public function __construct()
    {
        $this->middleware('permission:view expense', ['only' => ['getExpenses', 'saveExpense', 'prevExpenses']]);
    }
    /**
     * Save donation.
     */
    public function saveInsDonation(Request $request)
    {
        $this->validateDonation($request);

        $this->setDonationAttributes($request);
        $amount = $this->sanitizeAmount($request->amount);

        InstantRecord::create($this->getDonationData($request, $amount));

        return redirect()->route('dashboard')->with(['message' => 'Donation saved']);
    }

    /**
     * Save expense.
     */
    public function saveExpense(Request $request)
    {
        $this->validateExpense($request);

        $amount = $this->sanitizeAmount($request->amount);

        InstantRecord::create($this->getExpenseData($request, $amount));

        return redirect()->route('dashboard')->with(['message' => 'Expense saved']);
    }

    /**
     * Verify unverified donations.
     */
    public function verifyDonation(Request $request)
    {
        foreach ($request->input('verification', []) as $verificationId) {
            InstantRecord::findOrFail($verificationId)->update(['verification' => 1]);
        }

        return redirect()->route('dashboard')->with(['message' => 'Verification done']);
    }

    /**
     * Get all instant records.
     */
    public function getAllInstantRecords()
    {
        $instantRecords = $this->getRecords()->get();

        return view('admin.records.instant.instant_records', compact('instantRecords'));
    }

    /**
     * Get all instant unpaid donations.
     */
    public function getUnpaidDonations()
    {
        $unpaidDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 0]);

        return view('admin.records.instant.unpaid.unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Get all instant verified donations.
     */
    public function getVerifiedDonations()
    {
        $verifiedDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 1, 'verification' => 1]);

        return view('admin.records.instant.paid.verified_donations', compact('verifiedDonations'));
    }

    /**
     * Get all instant unverified donations.
     */
    public function getUnverifiedDonations()
    {
        $unverifiedDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 1, 'verification' => 0]);
        $recorder = User::all();

        return view('admin.records.instant.paid.unverified_donations', compact('unverifiedDonations', 'recorder'));
    }

    /**
     * Get all expenses.
     */
    public function getExpenses()
    {
        $expenses = $this->getDonations(['transaction' => 0]);

        return view('admin.records.instant.expenses.expenses', compact('expenses'));
    }

    /**
     * Edit pledges.
     */
    public function editPledges()
    {
        $unpaidDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 0]);

        return view('admin.records.instant.unpaid.edit_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Redeem a pledge.
     */
    public function redeemAPledge(Request $request)
    {
        InstantRecord::findOrFail($request->id)->update(['payment_status' => $request->payment_status]);

        return redirect()->route('instant.unpaid.donations')->with(['message' => 'Pledge redeemed']);
    }

    /**
     * Verify a donation.
     */
    public function verifyADonation(Request $request)
    {
        InstantRecord::findOrFail($request->id)->update(['verification' => $request->verification]);

        return redirect()->back()->with(['message' => 'Payment verified']);
    }

    /**
     * Redeem list of pledges.
     */
    public function redeemPledges(Request $request)
    {
        foreach ($request->input('payment_status', []) as $pledgeId) {
            InstantRecord::findOrFail($pledgeId)->update(['payment_status' => 1, 'verification' => 1]);
        }

        return redirect()->route('instant.edit.pledges')->with(['message' => 'Pledges redeemed']);
    }

    /**
     * Preview unpaid donations.
     */
    public function prevUnpaidDonations()
    {
        $unpaidDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 0]);

        return view('admin.records.instant.unpaid.prev_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Preview verified donations.
     */
    public function prevVerifiedDonations()
    {
        $verifiedDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 1, 'verification' => 1]);

        return view('admin.records.instant.paid.prev_verified_donations', compact('verifiedDonations'));
    }

    /**
     * Preview unverified donations.
     */
    public function prevUnverifiedDonations()
    {
        $unverifiedDonations = $this->getDonations(['transaction' => 1, 'payment_status' => 1, 'verification' => 0]);

        return view('admin.records.instant.paid.prev_unverified_donations', compact('unverifiedDonations'));
    }

    /**
     * Preview expenses.
     */
    public function prevExpenses()
    {
        $expenses = $this->getDonations(['transaction' => 0]);

        return view('admin.records.instant.expenses.prev_expenses', compact('expenses'));
    }

    /**
     * Update resource in storage.
     */
    public function updateTransaction(Request $request)
    {
        $this->setTransactionDefaults($request);
        $amount = $this->sanitizeAmount($request->amount);

        InstantRecord::findOrFail($request->id)->update($this->getTransactionData($request, $amount));

        return redirect()->back()->with(['message' => 'Transaction Updated']);
    }

    /**
     *
     *
     * Private methods
     */

    private function validateDonation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'purpose' => 'required',
            'transaction' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
            'phone' => 'required_if:payment_status, Unpaid',
        ], [
            'name.required' => 'Donor\'s fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
            'payment_mode.required' => 'Indicate the mode of payment',
            'phone.required' => 'Phone number of a pledging donor is required',
        ]);
    }

    private function validateExpense(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'purpose' => 'required',
            'transaction' => 'required',
            'amount' => 'required',
        ], [
            'name.required' => 'Donor\'s fullname and title is required',
            'purpose.required' => 'Purpose of donation is required',
            'amount.required' => 'Amount donated is required',
        ]);
    }

    private function setDonationAttributes(Request $request)
    {
        $request->event = getCurrentEvent();

        switch ($request->payment_mode) {
            case 1:
            case 2:
                $request->verification = 1;
                $request->payment_status = 1;
                break;
            case 3:
                $request->verification = 0;
                $request->payment_status = 1;
                break;
            case 4:
                $request->verification = 0;
                $request->payment_status = 0;
                break;
            default:
                $request->verification = 0;
                $request->payment_status = 0;
        }
    }

    private function sanitizeAmount($amount)
    {
        return intval(filter_var($amount, FILTER_SANITIZE_NUMBER_INT));
    }

    private function getDonationData($request, $amount)
    {
        return [
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
        ];
    }

    private function getExpenseData($request, $amount)
    {
        return [
            'recorder_id' => $request->recorder_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $amount,
            'payment_mode' => 0,
            'payment_status' => 2,
            'verification' => 0,
            'year' => $request->year,
        ];
    }

    private function getRecords()
    {
        return InstantRecord::orderBy('updated_at', 'DESC')
            ->where('year', '=', getCurrentYear());
    }

    private function getDonations(array $conditions)
    {
        return $this->getRecords()->where($conditions)->get();
    }

    private function setTransactionDefaults(Request $request)
    {
        if (!isset($request->payment_status) && $request->transaction == 1) {
            $request->payment_mode = 4;
            $request->payment_status = 0;
            $request->verification = 0;
        }

        $request->verification = $request->verification ?? 0;
        $request->payment_status = $request->payment_status ?? 0;
    }

    private function getTransactionData($request, $amount)
    {
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'transaction' => $request->transaction,
            'amount' => $amount,
            'payment_status' => $request->payment_status,
            'verification' => $request->verification,
        ];
    }
}