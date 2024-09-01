<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredRecord;
// use Spatie\Activitylog\Models\Activity;
// use Spatie\Activitylog\Facades\LogActivity;

class RegisteredRecordController extends Controller
{
    /**
     * Get all registered records.
     */
    public function getAllRegisteredRecords()
    {
        $registeredRecords = $this->getRegisteredRecords();

        return view('admin.records.registered.registered_records', compact('registeredRecords'));
    }

    /**
     * Save donation.
     */
    public function saveRegDonation(Request $request)
    {
        $this->validateRequest($request);

        $this->setRequestDefaults($request);

        $amount = $this->sanitizeAmount($request->amount);

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


        // activity()
        //     ->performedOn($donation)
        //     ->causedBy(auth()->user())
        //     ->withProperties(['customProperty' => 'value'])
        //     ->log('added a donation');

            // activity()
            //     ->causedBy(auth()->user())
            //     ->performedOn(new RegisteredRecord())
            //     ->log("{$request->user()->name} added a donation at " . now()->format('H:i'));

        return redirect()->route('dashboard')->with(['message' => 'Donation saved']);
    }

    /**
     * Update resource in storage.
     */
    public function updateDonation(Request $request)
    {
        $this->setUpdateDefaults($request);

        $amount = $this->sanitizeAmount($request->amount);

        RegisteredRecord::findOrFail($request->id)->update([
            'purpose' => $request->purpose,
            'amount' => $amount,
            'payment_status' => $request->payment_status,
            'verification' => $request->verification,
        ]);

        return redirect()->back()->with(['message' => 'Donation Updated']);
    }

    /**
     * Redeem Donor's Donation.
     */
    public function redeemDonorDonation(Request $request)
    {
        $this->updateVerification($request, 'Pledge redeemed');
    }

    /**
     * Get all registered verified donations.
     */
    public function getVerifiedDonations()
    {
        $verifiedDonations = $this->getDonations(['payment_status' => 1, 'verification' => 1]);

        return view('admin.records.registered.paid.verified_donations', compact('verifiedDonations'));
    }

    /**
     * Verify a donation.
     */
    public function verifyADonation(Request $request)
    {
        $this->updateVerification($request, 'Payment verified', 1);
    }

    /**
     * Unverify a donation.
     */
    public function unverifyADonation(Request $request)
    {
        $this->updateVerification($request, 'Payment unverified', 0);
    }

    /**
     * Preview all registered verified donations.
     */
    public function prevVerifiedDonations()
    {
        $verifiedDonations = $this->getDonations(['payment_status' => 1, 'verification' => 1]);

        return view('admin.records.registered.paid.prev_verified_donations', compact('verifiedDonations'));
    }

    /**
     * Get all registered unverified donations.
     */
    public function getUnverifiedDonations()
    {
        $unverifiedDonations = $this->getDonations(['payment_status' => 1, 'verification' => 0]);

        return view('admin.records.registered.paid.unverified_donations', compact('unverifiedDonations'));
    }

    /**
     * Preview all registered unverified donations.
     */
    public function prevUnverifiedDonations()
    {
        $unverifiedDonations = $this->getDonations(['payment_status' => 1, 'verification' => 0]);

        return view('admin.records.registered.paid.prev_unverified_donations', compact('unverifiedDonations'));
    }

    /**
     * Get all registered unpaid donations.
     */
    public function getUnpaidDonations()
    {
        $unpaidDonations = $this->getDonations(['payment_status' => 0]);

        return view('admin.records.registered.unpaid.unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Preview registered unpaid donations.
     */
    public function prevUnpaidDonations()
    {
        $unpaidDonations = $this->getDonations(['payment_status' => 0]);

        return view('admin.records.registered.unpaid.prev_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     * Edit registered unpaid donations.
     */
    public function editPledges()
    {
        $unpaidDonations = $this->getDonations(['payment_status' => 0]);

        return view('admin.records.registered.unpaid.edit_unpaid_donations', compact('unpaidDonations'));
    }

    /**
     *
     *
     * Private methods
     */

    private function getRegisteredRecords()
    {
        return RegisteredRecord::where('year', getCurrentYear())
            ->orderBy('updated_at', 'DESC')->get();
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'donor_id' => 'required',
            'amount' => 'required',
            'purpose' => 'required',
            'slip_no' => 'required',
            'payment_mode' => 'required',
        ], [
            'donor_id.required' => 'Donor\'s fullname and title is required',
            'amount.required' => 'Amount donated is required',
            'purpose.required' => 'Purpose of donation is required',
            'slip_no.required' => 'Slip number is required',
            'payment_mode.required' => 'Indicate the mode of payment',
        ]);
    }

    private function setRequestDefaults(Request $request)
    {
        $request->merge([
            'recorder_id' => getCurrentUser(),
            'event_id' => getCurrentEvent(),
            'year' => getCurrentYear(),
            'verification' => $this->getVerificationStatus($request->payment_mode),
            'payment_status' => $this->getPaymentStatus($request->payment_mode),
        ]);
    }

    private function setUpdateDefaults(Request $request)
    {
        $request->merge([
            'payment_mode' => $request->payment_mode ?? 4,
            'payment_status' => $request->payment_status ?? 0,
            'verification' => $request->verification ?? 0,
        ]);
    }

    private function sanitizeAmount($amount)
    {
        return intval(preg_replace('/[^\d]/', '', $amount));
    }

    private function getDonations(array $conditions)
    {
        return RegisteredRecord::where('year', getCurrentYear())
            ->where($conditions)
            ->orderBy('updated_at', 'DESC')->get();
    }

    private function getVerificationStatus($payment_mode)
    {
        return in_array($payment_mode, [1, 2]) ? 1 : 0;
    }

    private function getPaymentStatus($payment_mode)
    {
        return in_array($payment_mode, [1, 2, 3]) ? 1 : 0;
    }

    private function updateVerification(Request $request, $message, $verification = null)
    {
        $verification = $verification ?? $request->verification ?? 0;

        RegisteredRecord::findOrFail($request->id)->update([
            'verification' => $verification,
            'payment_status' => $request->payment_status ?? 0,
        ]);

        return redirect()->back()->with(['message' => $message]);
    }
}