<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all events from the database
        $events = DB::table('events')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.*', 'users.name as user_name')
            ->get();

        // Return the events to the view
        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Show the form to create a new event
        return view('events.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new event
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }
    public function show(Event $event)
    {
        // Show the details of a specific event
        return view('events.show', compact('event'));
    }
    public function edit(Event $event)
    {
        // Show the form to edit an existing event
        return view('events.edit', compact('event'));
    }
    public function update(Request $request, Event $event)
    {
        // Validate and update the event
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }
    public function destroy(Event $event)
    {
        // Delete the event
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    public function search(Request $request)
    {
        // Search for events based on the query
        $query = $request->input('query');
        $events = Event::where('name', 'LIKE', "%{$query}%")->get();

        return view('events.index', compact('events'));
    }
    public function filter(Request $request)
    {
        // Filter events based on the selected criteria
        $criteria = $request->input('criteria');
        $events = Event::where('category', $criteria)->get();

        return view('events.index', compact('events'));
    }
}
