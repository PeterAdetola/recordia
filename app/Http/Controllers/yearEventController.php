<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearRecord;
use App\Models\EventRecord;

class yearEventController extends Controller
{

    /**
     * Path to create year and/or event.
     */
    public function create(Request $request)
    {

        return view('admin.year_event.createYearEvent');
        
    }

    /**
     * Save the created year.
     */
    public function saveYear(Request $request)
    {

        $request->validate([
            'year' => 'required|date_format:Y',
        ],[
            'year.required' => 'Please enter year according to the stated format',
        ]);

        
        $request->status = 0;

      YearRecord::create([
            'year' => $request->year,
            'title' => $request->title,
            'status' => $request->status,
        ]);

        $notification = array(
            'message' => 'Activate newly created year'
        );

        return redirect()->route('create.year.event')->with($notification);
    }

    /**
     * Activate selected year.
     */
    public function activateYear(Request $request)
    {
        $selectedYearId = $request->input('status');


        // echo $selectedYearId;
        // exit();

        $existing_years = YearRecord::get();
        $active_year = $existing_years->where('status', '=', '1');

        if (count($active_year)){

            foreach ($active_year as $active_year){
            if ($active_year->id == $selectedYearId) {

            $notification = array(
                'message' => 'Year is already activated'
            );

            return redirect()->route('create.year.event')->with($notification);
            } else {

                // Update the selected row's status to active
                YearRecord::where('id', $selectedYearId)->update(['status' => 1]);

                // Update all other rows' status to inactive
                YearRecord::where('id', '!=', $selectedYearId)->update(['status' => 0]);

                    $notification = array(
                        'message' => 'Selected year activated'
                    );

                return redirect()->route('create.year.event')->with($notification);

                }

            }
        } else {

            // Update the selected row's status to active
            YearRecord::where('id', $selectedYearId)->update(['status' => 1]);
                
                    $notification = array(
                        'message' => 'Selected year activated'
                    );

            return redirect()->route('create.year.event')->with($notification);
            
        }
    }
}
