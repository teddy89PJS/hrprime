<?php

namespace App\Http\Controllers\planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PositionTitle;

class PositionTitleController extends Controller
{
    // Show the view with all position titles
    public function index()
    {
        $positionTitles = PositionTitle::all();
        return view('content.planning.position-title', compact('positionTitles'));
    }

    // Store a new position title
    public function store(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:50',
        ]);

        PositionTitle::create([
            'position_name' => $request->position_name,
            'abbreviation' => $request->abbreviation,
        ]);

        return response()->json(['message' => 'Position Title created successfully']);
    }

    // Update an existing position title
    public function update(Request $request, $id)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:50',
        ]);

        $positionTitle = PositionTitle::findOrFail($id);
        $positionTitle->update([
            'position_name' => $request->position_name,
            'abbreviation' => $request->abbreviation,
        ]);

        return response()->json(['message' => 'Position Title updated successfully']);
    }

    // Delete a position title
    public function destroy($id)
    {
        $positionTitle = PositionTitle::findOrFail($id);
        $positionTitle->delete();

        return response()->json(['message' => 'Position Title deleted successfully']);
    }
}
