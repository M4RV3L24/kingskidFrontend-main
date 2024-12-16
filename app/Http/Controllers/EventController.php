<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    
    public function showEvents()
    {
        $events = Event::query()->where('active', 1)->get();
        // available amount from amount in table donation
        foreach ($events as $event) {
            $event->available = $event->donations->sum('nominal');
        }

        return view('admin.events', ['events' => $events]);
    }
    

    public function addEvent(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'nominal' => 'required|numeric',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        try{
            // validation for start and end date
            if($validated['start_date'] > $validated['end_date']){
                return redirect()->route('admin.event.show')->with('error', 'Start date must be before end date');
            }
            $event = Event::create($validated);
            return redirect()->route('admin.event.show')->with('success', 'Event added successfully');
        }catch(\Throwable $th){
            return redirect()->route('admin.event.show')->with('error', 'Failed to add event');
        }
    }

    public function deleteEvent(Request $request)
    {
        $id = $request->id;

        try {
            $event = Event::find($id);
            $event->active = 0;
            $event->save();
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to delete event');

        }
        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully');
    }

    public function restoreEvent(Request $request)
    {
        $id = $request->id;

        try {
            $event = Event::find($id);
            $event->active = 1;
            $event->save();
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to restore event');

        }
        return redirect()->route('admin.dashboard')->with('success', 'Event restored successfully');
    }

    public function updateEvent(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:events,id',
            'name' => 'required',
            'nominal' => 'required|numeric',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        try {
            $event = Event::find($validated['id']);
            $event->update($validated);
            return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to update event');
        }
    }

    public function trashEvent(Request $request)
    {
        $id = $request->id;

        try {
            $event = Event::find($id);
            $event->delete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to remove event');
        }
        return redirect()->route('admin.dashboard')->with('success', 'Event remove successfully');
    }

}
