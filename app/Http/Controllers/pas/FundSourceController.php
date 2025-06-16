<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use App\Models\FundSource;
use Illuminate\Http\Request;




class FundSourceController extends Controller
{

public function index(Request $request)
{

    $sort = $request->get('sort', 'fund_source'); // Default sort by 'fund_source'
    $direction = $request->get('direction', 'asc'); // Default sort direction

    $fundsource = FundSource::orderBy($sort, $direction)->get();


    $fundsource = FundSource::orderBy($sort, $direction)->paginate(10)->appends(request()->query());
    return view('content.pas.fundsource', compact('fundsource', 'sort', 'direction'));
}



// Store Data Functions
    public function store(Request $request)
    {
    $request->validate([
      'fund_source' => 'required|string|max:255',
      'description' => 'required|string|max:255',
    ]);
// Create Data
    FundSource::create([
      'fund_source' => $request->fund_source,
      'description' => $request->description,
    ]);
    return redirect('/pas/fundsource')->with ('status','Fund Source Created Succesfully');
  }

    public function show(FundSource $fundsource)
    {
        return view('fundsource.show', compact('fundsource'));
    }

    public function edit(FundSource $fundsource)
    {
        return view('fundsource.edit', compact('fundsource'));
    }


    public function update(Request $request, FundSource $fundsource)
    {
      $request->validate([
      'fund_source' => 'required|string|max:255',
      'description' => 'required|string|max:255',
    ]);
// Update Data
    $fundsource->update([
      'fund_source' => $request->fund_source,
      'description' => $request->description,
    ]);
    return redirect('/pas/fundsource')->with ('status','Fund Source Updated Succesfully');
    }

      public function destroy(FundSource $fundsource)
    {
      $fundsource->delete();
      return redirect('/pas/fundsource')->with('status','Fund Source Deleted Successfully');
    }
}

