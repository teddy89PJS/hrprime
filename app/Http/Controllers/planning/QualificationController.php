<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::all();
        return view('content.planning.qualification', compact('qualifications'));
    }

        public function store(Request $request)
            {
                $request->validate([
                    'title' => 'required|string|unique:qualifications,title',
                    'description' => 'nullable|string',
                ]);

                Qualification::create([
                    'title' => strtoupper($request->title),
                    'description' => strtoupper($request->description),
                ]);

                return redirect()->back()->with('success', 'Qualification added.');
            }


            public function destroy($id)
            {
                Qualification::findOrFail($id)->delete();
                return response()->json(['success' => true]);
            }
            
                    public function update(Request $request, $id)
            {
                $request->validate([
                    'title' => 'required|string|unique:qualifications,title,' . $id,
                    'description' => 'nullable|string',
                ]);

                $qualification = Qualification::findOrFail($id);
                $qualification->update([
                    'title' => strtoupper($request->title),
                    'description' => strtoupper($request->description),
                ]);

                return response()->json(['success' => true]);
            }

}
