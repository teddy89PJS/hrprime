<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
  public function index()
  {
  $taxes = Tax::all();
  return view('content.pas.tax', compact('taxes'));
  }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'salary_grade' => 'required|numeric',
      'tax' => 'required|numeric'
    ]);

    $tax = Tax::create($validated);

    return response()->json([
      'salary_grade' => true,
      'tax' => $tax
    ]);
  }

  public function update(Request $request, $id)
  {
    $tax = Tax::findOrFail($id);

    $validated = $request->validate([
      'salary_grade' => 'required|numeric',
      'tax' => 'required|numeric'
    ]);

    $tax->update($validated);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $tax= Tax::findOrFail($id);
    $tax->delete();

    return response()->json(['success' => true]);
  }

}


