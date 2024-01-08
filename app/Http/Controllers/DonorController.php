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
    public function manageDonor(Donor $Donor)
    {

        $donors = Donor::orderBy('updated_at', 'DESC')->get();
        $donorDonations = RegisteredRecord::get();

        return view('admin.configs.config_donor', compact('donors'), compact('donorDonations'));
    }

    /**
     * Activate Donors.
     */
    public function activateDonors(Request $request)
    {
        //
    }

    /**
     * Get Donor's donations.
     */
    public function getDonorDonation($id)
    {
        $donor = Donor::where('id', $id)->first();
        $donorDonations = RegisteredRecord::with('event')->where('donor_id', $id)->orderBy('updated_at', 'DESC')->get();
        $paidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 1)->sum('amount'));
        $unpaidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 0)->sum('amount'));
        $sumDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)->sum('amount'));

        
        return view('admin.configs.donor_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }
    /**
     * Get Donor's donations.
     */
    public function prevDonorDonation($id)
    {
        $donor = Donor::where('id', $id)->first();
        $donorDonations = RegisteredRecord::with('event')->where('donor_id', $id)->orderBy('updated_at', 'DESC')->get();
        $paidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 1)->sum('amount'));
        $unpaidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 0)->sum('amount'));
        $sumDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)->sum('amount'));

        
        return view('admin.configs.prev_donor_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Get Current Donor's donations.
     */
    public function getCurrentDonorDonation($id)
    {
        $donor = Donor::where('id', $id)->first();
        $donorDonations = RegisteredRecord::with('event')->where('donor_id', $id)->where('year', '=', getCurrentYear())->where('event_id', '=', getCurrentEvent())->orderBy('updated_at', 'DESC')->get();
        $paidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 1)->where('year', '=', getCurrentYear())->where('event_id', '=', getCurrentEvent())->sum('amount'));
        $unpaidDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)
                            ->where('payment_status', 0)->where('year', '=', getCurrentYear())->where('event_id', '=', getCurrentEvent())->sum('amount'));
        $sumDonorDonations = formatAmount(RegisteredRecord::where('donor_id', $id)->where('year', '=', getCurrentYear())->where('event_id', '=', getCurrentEvent())->sum('amount'));

        
        return view('admin.configs.current_donor_donation', compact('donor', 'donorDonations', 'sumDonorDonations', 'paidDonorDonations', 'unpaidDonorDonations'));
    }

    /**
     * Edit a Donor.
     */
    public function updateDonor(Request $request)
    {
        $id = $request->id;

        if (isset($request->status)) {
            $request->status = 1;
        } else {
            $request->status = 0;
        }

        // (isset($request->status))? '$request->status = 1' : '$request->status = 0';

        Donor::findOrFail($id)->update([
        'title' => $request->title,
        'name'  => $request->name,
        'username' => $request->username,
        'phone'  => $request->phone,
        'status' => $request->status,
    ]);

        $notification = array(
            'message' => 'Donor Updated'
        );

        return redirect()->back()->with($notification);

    }

    /**
     * Save donor.
     */
    public function saveDonor(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'name'      => 'required',
            'username'  => 'required',
            'phone'     => 'required',
        ],[
            'title.required' => 'Donor\'s title is required',
            'name.required' => 'Donor\'s fullname is required',
            'username.required' => 'Donor\'s username is required',
            'phone.required' => 'Phone number of the donor is required',
        ]);


        if(isset($request->status)) {
            $request->status = 1;
        } else {
            $request->status = 0;            
        }

        // echo $request->status;
        // exit();

      $existingDonor = Donor::where('username', $request->username)
                     ->where('phone', $request->phone)
                     ->first();

      $existingUsername = Donor::where('username', $request->username)->first();

      $existingPhone = Donor::where('phone', $request->phone)->first();

if (!$existingDonor) {

    if (!$existingUsername) {

        if (!$existingPhone) {

          Donor::create([
                'title'     => $request->title,
                'name'      => $request->name,
                'username'  => $request->username,
                'phone'     => $request->phone,
                'status'    => $request->status,
            ]);

            $notification = array(
                'message' => 'Donor saved'
            );

            } else {

                $notification = array(
                    'message' => 'Phone number already exists'
                );

            }

        } else {

            $notification = array(
                'message' => 'Username already exists'
            );

        }

    } else {

        $notification = array(
            'message' => 'Donor already exists'
        );

    }

        return redirect()->back()->with($notification);
    }

}
