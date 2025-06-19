<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Section;
use App\Models\Division;

class UnitController extends Controller
{
  public function getSectionsByDivision($id)
  {
    $sections = Section::where('division_id', $id)->get();

    return response()->json($sections); // return as JSON
  }
  public function index()
  {
    $units = Unit::with('section.division')->get();
    $divisions = Division::all();
    return view('content.planning.unit', compact('units', 'divisions'));
  }
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'abbreviation' => 'required|string|max:10',
      'division_id' => 'required|exists:divisions,id',
      'section_id' => 'required|exists:sections,id',
    ]);

    Unit::create([
      'name' => $validated['name'],
      'abbreviation' => $validated['abbreviation'],
      'section_id' => $validated['section_id'],
    ]);

    return response()->json(['success' => true]);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'abbreviation' => 'required|string|max:10',
      'division_id' => 'required|exists:divisions,id',
      'section_id' => 'required|exists:sections,id',
    ]);

    $unit = Unit::find($id);

    if (!$unit) {
      return response()->json(['success' => false, 'message' => 'Unit not found.'], 404);
    }


    $unit->update([
      'name' => $validated['name'],
      'abbreviation' => $validated['abbreviation'],
      'section_id' => $validated['section_id'],
    ]);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $unit = Unit::find($id);

    if (!$unit) {
      return response()->json(['success' => false, 'message' => 'Unit not found.'], 404);
    }

    $unit->delete();

    return response()->json(['success' => true]);
  }
}
