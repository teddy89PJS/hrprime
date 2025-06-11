<?php

namespace App\Http\Controllers\learning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
  public function index()
  {
    $events = Event::all(); // Or apply filtering/sorting as needed
    return view('content.learning.events', compact('events'));
  }
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'type' => 'required|string',
      'dateFrom' => 'required|date',
      'dateTo' => 'required|date',
      'status' => 'required|string|max:255',
    ]);

    $event = new Event();
    $event->title = $validated['title'];
    $event->type = $validated['type'];
    $event->date_from = $validated['dateFrom'];
    $event->date_to = $validated['dateTo'];
    $event->status = $validated['status'];
    //  $event->added_by = auth()->user()->name ?? 'System';
    $event->save();

    return response()->json(['message' => 'Event saved successfully!']);
  }
  public function updateStatus(Request $request, $id)
  {
    $request->validate([
      'status' => 'required|in:Active,Inactive,Cancelled'
    ]);

    $event = Event::findOrFail($id);
    $event->status = $request->status;
    $event->save();

    return response()->json(['message' => 'Status updated successfully.']);
  }
}
