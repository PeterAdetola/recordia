<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearRecord;
use App\Models\EventRecord;

use Helpers\AppHelpers;

class configsController extends Controller
{


    /**
     * Path to create year, event and more.
     */
    public function manageConfigs(Request $request)
    {

        return view('admin.configs.configPage');
        
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

        return redirect()->route('manage.configs')->with($notification);
    }

    /**
     * Activate selected year.
     */
    public function activateYear(Request $request)
    {
        $selectedYearId = $request->input('status');

        $existing_years = YearRecord::get();
        $active_year = $existing_years->where('status', '=', '1');

        if (count($active_year)){

            foreach ($active_year as $active_year){

            if ($active_year->id == $selectedYearId) {

            $notification = array(
                'message' => 'Nothing to activate'
            );

            return redirect()->route('manage.configs')->with($notification);

            } else {

                // Update the selected row's status to active
                YearRecord::where('id', $selectedYearId)->update(['status' => 1]);

                // Update all other rows' status to inactive
                YearRecord::where('id', '!=', $selectedYearId)->update(['status' => 0]);

                    $notification = array(
                        'message' => 'Year '.getCurrentYear().' is activated'
                    );

                return redirect()->route('manage.configs')->with($notification);

                }

            }

        } else {

            // Update the selected row's status to active
            YearRecord::where('id', $selectedYearId)->update(['status' => 1]);
                
                    $notification = array(
                        'message' => 'Selected year activated'
                    );

            return redirect()->route('manage.configs')->with($notification);

        }
    }


    /**
     * Update year details.
     */
    public function updateYear(Request $request)
    {
        $id = $request->id;        

        YearRecord::findOrFail($id)->update([
        'year' => $request->year,
        'title' => $request->title,
    ]);

        $notification = array(
            'message' => 'Year details updated'
        );

        return redirect()->route('manage.configs')->with($notification);
    }
}
