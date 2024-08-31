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
        $donorDonations = RegisteredRecord::all();

        return view('admin.configs.config_donor', compact('donors', 'donorDonations'));
    }

    /**
     * Activate Donors.
     */
    public function activateDonors(Request $request)
    {
        // Implementation here
    }

    /**
     * Get Donor's donations.
     */
    public function getDonorDonation($id)
    {
        $donor = Donor::findOrFail($id);
        $donorDonations = $this->getDonorRecords($id);
        $donorEventDonations = $this->getDonorRecords($id, true);
        $paidDonorDonations = $this->formatDonations($id, 1);
        $unpaidDonorDonations = $this->formatDonations($id, 0);
        $sumDonorDonations = $this->formatDonations($id);

        return view('admin.configs.donor_donation', compact('donor', 'donorDonations', 'donorEventDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Get Donor's previous donations.
     */
    public function prevDonorDonation($id)
    {
        $donor = Donor::findOrFail($id);
        $donorDonations = $this->getDonorRecords($id);
        $paidDonorDonations = $this->formatDonations($id, 1);
        $unpaidDonorDonations = $this->formatDonations($id, 0);
        $sumDonorDonations = $this->formatDonations($id);

        return view('admin.configs.prev_donor_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Get Donor's current donations.
     */
    public function getDonorCurrentDonation($id)
    {
        $donor = Donor::findOrFail($id);
        $donorDonations = $this->getDonorRecords($id, true);
        $paidDonorDonations = $this->formatDonations($id, 1, true);
        $unpaidDonorDonations = $this->formatDonations($id, 0, true);
        $sumDonorDonations = $this->formatDonations($id, null, true);

        return view('admin.configs.donor_current_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Get Donor's current donations preview.
     */
    public function prevDonorCurrentDonation($id)
    {
        $donor = Donor::findOrFail($id);
        $donorDonations = $this->getDonorRecords($id, true);
        $paidDonorDonations = $this->formatDonations($id, 1, true);
        $unpaidDonorDonations = $this->formatDonations($id, 0, true);
        $sumDonorDonations = $this->formatDonations($id, null, true);

        return view('admin.configs.prev_donor_current_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Edit a Donor.
     */
    public function updateDonor(Request $request)
    {
        $id = $request->id;
        $status = $request->has('status') ? 1 : 0;

        Donor::findOrFail($id)->update($request->only('title', 'name', 'username', 'phone') + ['status' => $status]);

        return redirect()->back()->with(['message' => 'Donor Updated']);
    }

    /**
     * Save donor.
     */
    public function saveDonor(Request $request)
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

        $status = $request->has('status') ? 1 : 0;

        if (Donor::where('username', $request->username)->exists()) {
            return redirect()->back()->with(['message' => 'Username already exists']);
        }

        if (Donor::where('phone', $request->phone)->exists()) {
            return redirect()->back()->with(['message' => 'Phone number already exists']);
        }

        Donor::create($request->only('title', 'name', 'username', 'phone') + ['status' => $status]);

        return redirect()->back()->with(['message' => 'Donor saved']);
    }

    /**
     * Helper function to get donor records.
     */
    private function getDonorRecords($id, $current = false)
    {
        $query = RegisteredRecord::with('event')->where('donor_id', $id);

        if ($current) {
            $query->where('year', getCurrentYear())->where('event_id', getCurrentEvent());
        }

        return $query->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * Helper function to format donations.
     */
    private function formatDonations($id, $status = null, $current = false)
    {
        $query = RegisteredRecord::where('donor_id', $id);

        if (!is_null($status)) {
            $query->where('payment_status', $status);
        }

        if ($current) {
            $query->where('year', getCurrentYear())->where('event_id', getCurrentEvent());
        }

        return formatAmount($query->sum('amount'));
    }
}