<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    /**
     * Get all events.
     */
    public function manageEvent(Request $request)
    {

        $tab = '';

        $events = Event::orderBy('updated_at', 'DESC')->get();

        return view('admin.configs.config_event', compact('tab', 'events',));
    }

    /**
     * Save event
     */
    public function saveEvent(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Donor\'fullname and title is required',
        ]);
        $activateClicked = isset($request->status);

        if(!$activateClicked) {
            $request->status = 0;
            $feedback = 0; 
        } else {
        // Update all other rows' status to inactive
        Event::where('status', '=', 1)->update(['status' => 0]);
            $feedback = 1; 
        }

        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);

      Event::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

    if($feedback == 0) {
        $notification = array(
            'message' => 'Event Created',
            'eventMessageTitle' => 'Event is created!',
            'eventMessage' => 'You can further activate the created event by clicking on the event of choice and click the activate button.'
        );
    } else {
        $notification = array(
            'message' => 'Event created and activated',
            'eventMessageTitle' => getCurrentEvent().' is created and activated!',
            'eventMessage' => 'All activities will be done to '.getCurrentEvent().'.'
        );
    }

        return redirect()->back()->with($notification);
       
    }
       

    /**
     * Activate selected event.
     */
    public function activateEvent(Request $request)
    {
        $selectedEventId = $request->input('status');



        $existing_events = Event::get();
        $active_event = $existing_events->where('status', '=', '1');

    if (count($active_event)){

            foreach ($active_event as $active_event){

        if ($active_event->id == $selectedEventId) {

            $notification = array(
                'message' => 'Nothing to activate'
            );

            return redirect()->route('manage.event')->with($notification);

        } else {

        // Create session with tab value
        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);

            // Update the selected row's status to active
            Event::where('id', $selectedEventId)->update(['status' => 1]);

            // Update all other rows' status to inactive
            Event::where('id', '!=', $selectedEventId)->update(['status' => 0]);

           

            $notification = array(
                'message' => 'Event activated',
                'eventMessageTitle' => getCurrentEvent().' is activated!',
                'eventMessage' => 'All activities will be done to '.getCurrentEvent().'.'
            );

            return redirect()->route('manage.event')->with($notification);

                }

            }

    } else {

            // Update the selected row's status to active
            Event::where('id', $selectedEventId)->update(['status' => 1]);
                
                    $notification = array(
                        'message' => 'Selected event activated'
                    );

            return redirect()->route('manage.event')->with($notification);

        }
    }


    /**
     * Update event details.
     */
    public function updateEvent(Request $request)
    {
        $id = $request->id; 

        $expiresAt = time() + 1; 
        session(['tab' => $request->tab, 'expires_at' => $expiresAt]);      

        Event::findOrFail($id)->update([
        'name' => $request->name,
    ]);

        $notification = array(
            'message' => 'Event details updated'
        );

        return redirect()->route('manage.event')->with($notification);
    }
}
