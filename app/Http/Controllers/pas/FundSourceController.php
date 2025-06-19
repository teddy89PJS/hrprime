<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use App\Models\FundSource;
use Illuminate\Http\Request;




class FundSourceController extends Controller
{

public function index()
  {
    $fundsources = FundSource::all();
    return view('content.pas.fundsource', compact('fundsources'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'fund_source' => 'required|string|max:50',
      'description' => 'required|string|max:255'
    ]);

    $fundsource = FundSource::create($validated);

    return response()->json([
      'success' => true,
      'fundsource' => $fundsource
    ]);
  }

  public function update(Request $request, $id)
  {
    $fundsource = FundSource::findOrFail($id);

    $validated = $request->validate([
      'fund_source' => 'required|string|max:50',
      'description' => 'required|string|max:255'
    ]);

    $fundsource->update($validated);

    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $fundsource = FundSource::findOrFail($id);
    $fundsource->delete();

    return response()->json(['success' => true]);
  }



}








