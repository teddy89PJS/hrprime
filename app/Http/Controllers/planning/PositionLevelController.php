<?php

namespace App\Http\Controllers\planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PositionLevel;

class PositionLevelController extends Controller
{
    // Show the view with all position levels
    public function index()
    {
        $positionLevels = PositionLevel::all();
        return view('content.planning.position-level', compact('positionLevels'));
    }

    // Store a new position level
    public function store(Request $request)
    {
        $request->validate([
            'level_name'    => 'required|string|max:255',
            'abbreviation'  => 'nullable|string|max:50',
            'level_rank'    => 'nullable|integer',
        ]);

        PositionLevel::create([
            'level_name'    => $request->level_name,
            'abbreviation'  => $request->abbreviation,
            'level_rank'    => $request->level_rank,
        ]);

        return response()->json(['message' => 'Position Level created successfully']);
    }

    // Update an existing position level
    public function update(Request $request, $id)
    {
        $request->validate([
            'level_name'    => 'required|string|max:255',
            'abbreviation'  => 'nullable|string|max:50',
            'level_rank'    => 'nullable|integer',
        ]);

        $positionLevel = PositionLevel::findOrFail($id);
        $positionLevel->update([
            'level_name'    => $request->level_name,
            'abbreviation'  => $request->abbreviation,
            'level_rank'    => $request->level_rank,
        ]);

        return response()->json(['message' => 'Position Level updated successfully']);
    }

    // Delete a position level
    public function destroy($id)
    {
        $positionLevel = PositionLevel::findOrFail($id);
        $positionLevel->delete();

        return response()->json(['message' => 'Position Level deleted successfully']);
    }
}
