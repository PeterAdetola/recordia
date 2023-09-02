<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearRecord;

class yearController extends Controller
{
    public function create(Request $request)
    {

        return view('admin.create_year');
        
    } //End Method |-------------------
    /**
     * Store a newly created resource in storage.
     */
    public function saveYear(Request $request)
    {

        $request->validate([
            'year' => 'required|date_format:Y',
        ],[
            'year.required' => 'Please enter year according to the stated format',
        ]);

      YearRecord::create([
            'year' => $request->year,
        ]);

        $notification = array(
            'message' => 'New year created'
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
