<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use App\Models\FundSource;
use Illuminate\Http\Request;

class FundSourceController extends Controller
{
  public function index(Request $request)
  {
    $sort = $request->get('sort', 'fund_source');
    $direction = $request->get('direction', 'asc');

    $fundsource = FundSource::orderBy($sort, $direction)->paginate(10)->appends(request()->query());
    return view('content.pas.fundsource', compact('fundsource', 'sort', 'direction'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'fund_source' => 'required|string|max:255',
      'description' => 'required|string|max:255',
    ]);

    FundSource::create($request->only(['fund_source', 'description']));
    return redirect()->route('fundsource.index')->with('status', 'Fund Source Created Successfully');
  }

  public function update(Request $request, FundSource $fundsource)
  {
    $request->validate([
      'fund_source' => 'required|string|max:255',
      'description' => 'required|string|max:255',
    ]);

    $fundsource->update($request->only(['fund_source', 'description']));
    return redirect()->route('fundsource.index')->with('status', 'Fund Source Updated Successfully');
  }

  public function destroy(FundSource $fundsource)
  {
    $fundsource->delete();
    return redirect()->route('fundsource.index')->with('status', 'Fund Source Deleted Successfully');
  }
}
