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
        // $donations = RegisteredRecord::orderBy('updated_at', 'DESC')->get();

        return view('admin.configs.config_donor', compact('donors'));
    }

    /**
     * Activate Donors.
     */
    public function activateDonors(Request $request)
    {
        //
    }

    /**
     * Get Donor.
     */
    public function getDonor(Request $request)
    {
        //
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

        return redirect()->back()->with($notification);
    }

}
