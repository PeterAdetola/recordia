<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\RegisteredRecord;

class DonorController extends Controller
{
    /**
     * Get Registered Donors.
     */
    public function manageDonor()
    {
        $donors = Donor::orderBy('updated_at', 'DESC')->get();
        $donorDonations = RegisteredRecord::get();

        return view('admin.configs.config_donor', compact('donors', 'donorDonations'));
    }

    /**
     * Activate Donors.
     */
    public function activateDonors(Request $request)
    {
        // Implementation needed
    }

    /**
     * Get Donor's donations.
     */
    public function getDonorDonation($id)
    {
        return $this->donorDonationView($id, 'admin.configs.donor_donation');
    }

    /**
     * Preview Donor's donations.
     */
    public function prevDonorDonation($id)
    {
        return $this->donorDonationView($id, 'admin.configs.prev_donor_donation');
    }

    /**
     * Get Donor's Current donations.
     */
    public function getDonorCurrentDonation($id)
    {
        return $this->donorCurrentDonationView($id, 'admin.configs.donor_current_donation');
    }

    /**
     * Preview Donor's Current donations.
     */
    public function prevDonorCurrentDonation($id)
    {
        return $this->donorCurrentDonationView($id, 'admin.configs.prev_donor_current_donation');
    }

    /**
     * Edit a Donor.
     */
    public function updateDonor(Request $request)
    {
        $request->status = isset($request->status) ? 1 : 0;

        Donor::findOrFail($request->id)->update($request->only(['title', 'name', 'username', 'phone', 'status']));

        return redirect()->back()->with(['message' => 'Donor Updated']);
    }

    /**
     * Save donor.
     */
    public function saveDonor(Request $request)
    {
        $this->validateDonor($request);

        $request->status = isset($request->status) ? 1 : 0;

        if ($this->donorExists($request)) {
            return redirect()->back()->with(['message' => 'Donor already exists']);
        }

        Donor::create($request->only(['title', 'name', 'username', 'phone', 'status']));

        return redirect()->back()->with(['message' => 'Donor saved']);
    }

    /**
     *
     *
     * Private methods
     */

    private function donorDonationView($id, $view)
    {
        $donor = $this->getDonor($id);
        $donorDonations = $this->getDonorDonations($id);
        $donorEventDonations = $this->getDonorEventDonations($id);
        $paidDonorDonations = $this->getPaidDonorDonations($id);
        $unpaidDonorDonations = $this->getUnpaidDonorDonations($id);
        $sumDonorDonations = $this->getSumDonorDonations($id);

        return view($view, compact(
            'donor', 'donorDonations', 'donorEventDonations',
            'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'
        ));
    }

    private function donorCurrentDonationView($id, $view)
    {
        $donor = $this->getDonor($id);
        $donorDonations = $this->getDonorEventDonations($id);
        $paidDonorDonations = $this->getPaidDonorDonations($id, true);
        $unpaidDonorDonations = $this->getUnpaidDonorDonations($id, true);
        $sumDonorDonations = $this->getSumDonorDonations($id, true);

        return view($view, compact(
            'donor', 'donorDonations', 'sumDonorDonations',
            'paidDonorDonations', 'unpaidDonorDonations'
        ));
    }

    private function getDonor($id)
    {
        return Donor::findOrFail($id);
    }

    private function getDonorDonations($id)
    {
        return RegisteredRecord::with('event')->where('donor_id', $id)
            ->orderBy('updated_at', 'DESC')->get();
    }

    private function getDonorEventDonations($id)
    {
        return RegisteredRecord::with('event')->where('donor_id', $id)
            ->where('year', getCurrentYear())
            ->where('event_id', getCurrentEvent())
            ->orderBy('updated_at', 'DESC')->get();
    }

    private function getPaidDonorDonations($id, $current = false)
    {
        $query = RegisteredRecord::where('donor_id', $id)
            ->where('payment_status', 1);

        if ($current) {
            $query->where('year', getCurrentYear())->where('event_id', getCurrentEvent());
        }

        return formatAmount($query->sum('amount'));
    }

    private function getUnpaidDonorDonations($id, $current = false)
    {
        $query = RegisteredRecord::where('donor_id', $id)
            ->where('payment_status', 0);

        if ($current) {
            $query->where('year', getCurrentYear())->where('event_id', getCurrentEvent());
        }

        return formatAmount($query->sum('amount'));
    }

    private function getSumDonorDonations($id, $current = false)
    {
        $query = RegisteredRecord::where('donor_id', $id);

        if ($current) {
            $query->where('year', getCurrentYear())->where('event_id', getCurrentEvent());
        }

        return formatAmount($query->sum('amount'));
    }

    private function validateDonor(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required',
        ], [
            'title.required' => 'Donor\'s title is required',
            'name.required' => 'Donor\'s fullname is required',
            'username.required' => 'Donor\'s username is required',
            'phone.required' => 'Phone number of the donor is required',
        ]);
    }

    private function donorExists(Request $request)
    {
        return Donor::where('username', $request->username)
            ->orWhere('phone', $request->phone)
            ->exists();
    }
}