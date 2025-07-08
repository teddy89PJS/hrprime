<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use App\Models\JoRequest;
use App\Models\Section;
use App\Models\FundSource;
use Illuminate\Http\Request;

class JoRequestController extends Controller
{
  public function index()
  {
    $requests = JoRequest::with(['section', 'fundSource'])->latest()->get();
    $sections = Section::all();
    $fundSources = FundSource::all();

    return view('content.planning.jo-requests.index', compact('requests', 'sections', 'fundSources'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'type' => 'required|in:CMF,DR',
      'subject' => 'required|string|max:255',
      'section_id' => 'required|exists:sections,id',
      'position_name' => 'required|string|max:255',
      'no_of_position' => 'required|integer|min:1',
      'effectivity_of_position' => 'required|date',
      'fund_source_id' => 'nullable|exists:fund_sources,id',
      'remarks' => 'nullable|string',
    ]);

    JoRequest::create($validated);

    return redirect()->back()->with('success', 'JO request submitted successfully.');
  }
  public function edit(JoRequest $joRequest)
  {
    $sections = Section::all();
    $fundSources = FundSource::all();

    return view('content.planning.jo-requests.edit', compact('joRequest', 'sections', 'fundSources'));
  }

  public function update(Request $request, JoRequest $joRequest)
  {
    $validated = $request->validate([
      'type' => 'required|in:CMF,DR',
      'subject' => 'required|string|max:255',
      'section_id' => 'required|exists:sections,id',
      'position_name' => 'required|string|max:255',
      'no_of_position' => 'required|integer|min:1',
      'effectivity_of_position' => 'required|date',
      'fund_source_id' => 'nullable|exists:fund_sources,id',
      'remarks' => 'nullable|string',
    ]);

    $joRequest->update($validated);

    return redirect()->route('planning.jo-requests.index')->with('success', 'JO request updated successfully.');
  }
  public function approve(JoRequest $joRequest)
  {
    $joRequest->update(['status' => 'approved']);
    return redirect()->back()->with('success', 'Request approved successfully.');
  }

  public function disapprove(JoRequest $joRequest)
  {
    $joRequest->update(['status' => 'disapproved']);
    return redirect()->back()->with('success', 'Request disapproved successfully.');
  }
  public function print(JoRequest $joRequest)
  {
    return view('content.planning.jo-requests.print', compact('joRequest'));
  }
}
