<?php

namespace App\Http\Controllers\Planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;

class VacantPositionController extends Controller
{
    public function index()
    {
        // Fetch all positions marked as vacant
        $vacantPositions = Position::with(['qualification', 'qualifiedStaff'])
            ->where('is_vacant', true)
            ->get();

        return view('content.planning.vacant-position', compact('vacantPositions'));
    }
}
