<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $eventService;

    function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index()
    {
        $events = $this->eventService->getAll();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $this->eventService->create($request->post());

        return redirect()->route('events.index')->with('success', 'Event has been created successfully.');
    }

    public function edit($id)
    {
        $event = $this->eventService->get($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $this->eventService->update($request->post());

        return redirect()->route('events.index')->with('success', 'Event Has Been updated successfully');
    }

    public function destroy($id)
    {
        $this->eventService->delete($id);
        return redirect()->route('events.index')->with('success', 'Event has been deleted successfully');
    }

}
