<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearRecord;
use App\Models\Event;

use Helpers\AppHelpers;

class YearController extends Controller
{


    /**
     * Path to create year, event and more.
     */
    public function manageYear(Request $request)
    {

        $tab = '';

        $existing_years = YearRecord::orderBy('year', 'desc')->get();
        

    return view('admin.configs.config_year', compact('tab', 'existing_years'));
        
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

        $existingYears = YearRecord::where('year', $request->year)->first();
        
        $request->status = 0;

        if(!$existingYears){
        // Create session with tab value
        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);

      YearRecord::create([
            'year' => $request->year,
            'title' => $request->title,
            'status' => $request->status,
        ]);

        $notification = array(
            'message' => 'New year created',
            'yearMessageTitle' => 'Congratulations, new year created!',
            'yearMessage' => 'Select the created year to activate it for financial activities and records.'
        );

        return redirect()->route('manage.year')->with($notification);

            } else {

        $notification = array(
            'message' => 'Year already exists'
        );

        return redirect()->route('manage.year')->with($notification);

            }

    }
       

    /**
     * Activate selected year.
     */
    public function activateYear(Request $request)
    {
        $selectedYearId = $request->input('status');



        $existing_years = YearRecord::get();
        $active_year = $existing_years->where('status', '=', '1');
// Check for active year
    if (count($active_year)){

            foreach ($active_year as $active_year){

        if ($active_year->id == $selectedYearId) {

            $notification = array(
                'message' => 'Nothing to activate'
            );

            return redirect()->route('manage.year')->with($notification);

        } else {

        // Create session with tab value
        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);

            // Update the selected row's status to active
            YearRecord::where('id', $selectedYearId)->update(['status' => 1]);
            // Update all other rows' status to inactive
            YearRecord::where('id', '!=', $selectedYearId)->update(['status' => 0]);
           

            $notification = array(
                'message' => 'Year '.getCurrentYear().' is activated',
                'yearMessageTitle' => 'Congratulations, year '.getCurrentYear().' is activated!',
                'yearMessage' => 'All activities will be done to the year '.getCurrentYear().'  and records for the year '.getCurrentYear().'  will be displayed if it exists.'
            );

            return redirect()->route('manage.year')->with($notification);

                }

            }

    } else {

            // Update the selected row's status to active
            YearRecord::where('id', $selectedYearId)->update(['status' => 1]);
                
                    $notification = array(
                        'message' => 'Selected year activated'
                    );

            return redirect()->route('manage.year')->with($notification);

        }
    }


    /**
     * Update year details.
     */
    public function updateYear(Request $request)
    {
        $id = $request->id; 

        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);      

        YearRecord::findOrFail($id)->update([
        'year' => $request->year,
        'title' => $request->title,
    ]);

        $notification = array(
            'message' => 'Year details updated'
        );

        return redirect()->route('manage.year')->with($notification);
    }


}
