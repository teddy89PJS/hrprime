<?php

namespace App\Http\Controllers\planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PositionTitle;

class PositionTitleController extends Controller
{
    public function index()
    {
        $positionTitles = PositionTitle::all();
        return view('content.planning.position-title', compact('positionTitles'));
    }
}
