<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VacantPosition;

class VacantPositionController extends Controller
{
    public function index()
    {
        $vacantPositions = VacantPosition::with('qualification', 'qualifiedStaff')
            ->where('is_vacant', true)
            ->get();

        return view('content.planning.open-positions', compact('vacantPositions'));
    }
}
