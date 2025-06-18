<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Section;

class SectionController extends Controller
{
  public function index()
  {
    $sections = Section::with('division')->get();
    $divisions = Division::all();
    return view('content.planning.section', compact('sections', 'divisions'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'division_id' => 'required|exists:divisions,id',
      'name' => 'required|string|max:255',
      'abbreviation' => 'required|string|max:50',
    ]);

    Section::create($validated);

    return response()->json(['success' => true]);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'division_id' => 'required|exists:divisions,id',
      'name' => 'required|string|max:255',
      'abbreviation' => 'required|string|max:50',
    ]);

    $section = Section::findOrFail($id);
    $section->update($validated);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $section = Section::findOrFail($id);
    $section->delete();

    return response()->json(['success' => true]);
  }
}
