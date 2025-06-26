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
                'title' => 'required|string|unique:qualifications,title'
            ]);

            Qualification::create([
                'title' => $request->title
            ]);

            return redirect()->back()->with('success', 'Qualification added.');
        }

    public function destroy($id)
    {
        Qualification::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Qualification deleted.');
    }
}
