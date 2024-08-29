<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Get all events.
     */
    public function manageEvent()
    {
        $tab = '';
        $events = Event::orderBy('updated_at', 'DESC')->get();
        $noEvent = Event::where('status', 1)->doesntExist() ? 1 : 0;

        return view('admin.configs.config_event', compact('tab', 'events', 'noEvent'));
    }

    /**
     * Save event.
     */
    public function saveEvent(Request $request)
    {
        $this->validateEvent($request);
        $activateClicked = $request->filled('status');

        if ($activateClicked) {
            Event::where('status', '=', 1)->update(['status' => 0]);
            $request->status = 1;
        } else {
            $request->status = 0;
        }

        $this->setSessionTab($request->tab);

        Event::create($request->only(['name', 'status']));

        return redirect()->back()->with($this->getSaveNotification($activateClicked));
    }

    /**
     * Activate selected event.
     */
    public function activateEvent(Request $request)
    {
        $selectedEventId = $request->input('status');
        $noEvent = $request->input('no_event');

        if ($noEvent) {
            return $this->activateNoEvent($request);
        }

        $this->setSessionTab($request->tab);

        $activeEvent = Event::where('status', 1)->first();

        if ($activeEvent && $activeEvent->id == $selectedEventId) {
            return redirect()->route('manage.event')->with(['message' => 'Nothing to activate']);
        }

        $this->activateEventById($selectedEventId);

        return redirect()->route('manage.event')->with($this->getActivationNotification());
    }

    /**
     * Update event details.
     */
    public function updateEvent(Request $request)
    {
        $this->setSessionTab($request->tab);

        Event::findOrFail($request->id)->update(['name' => $request->name]);

        return redirect()->route('manage.event')->with(['message' => 'Event details updated']);
    }

    /**
     *
     *
     * Private methods
     */

    private function validateEvent(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Event name is required',
        ]);
    }

    private function setSessionTab($tab)
    {
        session(['tab' => $tab, 'expires_at' => time() + 1]);
    }

    private function getSaveNotification($activateClicked)
    {
        if ($activateClicked) {
            return [
                'message' => 'Event created and activated',
                'eventMessageTitle' => getCurrentEventName() . ' is created and activated!',
                'eventMessage' => 'All activities will be done to ' . getCurrentEventName() . '.',
            ];
        }

        return [
            'message' => 'Event Created',
            'eventMessageTitle' => 'Event is created!',
            'eventMessage' => 'You can further activate the created event by clicking on the event of choice and clicking the activate button.',
        ];
    }

    private function activateNoEvent(Request $request)
    {
        $this->setSessionTab($request->tab);

        return redirect()->route('manage.event')->with([
            'message' => 'No event activated',
            'eventMessageTitle' => getCurrentEventName() . ' is activated!',
            'eventMessage' => 'All activities will be done to ' . getCurrentEventName() . '.',
        ]);
    }

    private function activateEventById($selectedEventId)
    {
        Event::where('id', $selectedEventId)->update(['status' => 1]);
        Event::where('id', '!=', $selectedEventId)->update(['status' => 0]);
    }

    private function getActivationNotification()
    {
        return [
            'message' => 'Event activated',
            'eventMessageTitle' => getCurrentEventName() . ' is activated!',
            'eventMessage' => 'All activities will be done to ' . getCurrentEventName() . '.',
        ];
    }
}