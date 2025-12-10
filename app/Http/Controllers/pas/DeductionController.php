<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deduction;

class DeductionController extends Controller
{

  public function index()
  {
    $deductions = Deduction::all();
    return view('content.pas.deductions', compact('deductions'));
  }

  public function create()
  {
    return view('deductions.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'deduction_name' => 'required|string|max:255',
      'deduction_amount' => 'required|numeric|min:0',
    ]);

    $deductions = Deduction::create($validated);

    return response()->json([
      'success' => true,
      'deduction' => $deductions
    ]);
  }

  public function update(Request $request, $id)
  {
    $deductions = Deduction::findOrFail($id);

    $validated = $request->validate([
      'deduction_name' => 'required|string|max:255',
      'deduction_amount' => 'required|numeric|min:0',
    ]);

    $deductions->update($validated);

    return response()->json([
      'success' => true,
      'deduction' => $deductions
    ]);
  }

  public function destroy($id)
  {
    $deductions = Deduction::findOrFail($id);
    $deductions->delete();

    return response()->json([
      'success' => true,
      'deduction' => $deductions
    ]);
  }


}
