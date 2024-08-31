<?php

namespace App\Http\Controllers;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    
    public function update(Request $request)
    {
        $id = $request->id;
        if($request->display_donations_by_event == '') {
            $request->display_donations_by_event = 0;
        }
        $displayByEvent = $request->display_donations_by_event;

        Setting::findOrFail($id)->update([
                'display_donations_by_event' => $request->display_donations_by_event,
            ]);

        $notification = array(
            'message' => 'Setting updated successfully!',
        );
        
        return redirect()->back()->with($notification);
    }
}
