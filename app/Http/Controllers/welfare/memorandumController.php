<?php

namespace App\Http\Controllers\Welfare;

use Illuminate\Http\Request;
use App\Models\Welfare\Memorandum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Js;


class MemorandumController extends Controller
{
    public function index(Request $request)
    {
        $query = Memorandum::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('issuance_number', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by award_type
        if ($request->has('award_type') && $request->award_type != 'all') {
            $query->where('award_type', $request->award_type);
        }

        // Date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date_of_issuance', [$request->start_date, $request->end_date]);
        }
        if (!empty($request->start_date) && !empty($request->end_date)) {
        $query->whereBetween('date_of_issuance', [$request->start_date, $request->end_date]);
        }


        $memorandums = $query->latest()->paginate(10);

        if ($request->ajax()) {
        try {
            return view('partials.welfare.memorandum_table', compact('memorandums'))->render();
        } catch (\Throwable $e) {
            Log::error('AJAX view error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to render table.'], 500);
        }
}


        return view('content.welfare.memorandum', compact('memorandums'));
    }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'issuance_number' => 'required|string|max:255',
                'subject' => 'required|string',
                'award_type' => 'required|in:character,praise',
                'date_of_issuance' => 'required|date',
                'file' => 'required|file|mimes:pdf|max:10240',
                'notes' => 'nullable|string'
            ]);

            // 👇 Custom filename logic
            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('memorandums', $filename, 'public');

            Memorandum::create([
                'issuance_number' => $validated['issuance_number'],
                'subject' => $validated['subject'],
                'award_type' => $validated['award_type'],
                'date_of_issuance' => $validated['date_of_issuance'],
                'file_path' => $path,
                'file_version' => '1.0',
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()->route('welfare.memorandum')->with('success', 'Memorandum Added Successfully.');
        }


    // ✅ Add the update() method here
    public function update(Request $request, $id)
    {
        $request->validate([
            'issuance_number' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'award_type' => 'required|string',
            'date_of_issuance' => 'required|date',
            'notes' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $memorandum = Memorandum::findOrFail($id);

        $memorandum->issuance_number = $request->issuance_number;
        $memorandum->subject = $request->subject;
        $memorandum->award_type = $request->award_type;
        $memorandum->date_of_issuance = $request->date_of_issuance;
        $memorandum->notes = $request->notes;

        if ($request->hasFile('file')) {
            if ($memorandum->file_path && Storage::disk('public')->exists($memorandum->file_path)) {
                Storage::disk('public')->delete($memorandum->file_path);
            }

            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('memorandums', $filename, 'public');
            $memorandum->file_path = $path;

        }

        $memorandum->save();

        return redirect()->route('welfare.memorandum')->with('success', 'Memorandum Updated Successfully.');
    }

    public function destroy($id)
    {
        $memorandum = Memorandum::findOrFail($id);
        $memorandum->delete();

        return redirect()->route('welfare.memorandum')->with('success', 'Memorandum Deleted Successfully.');
    }
}