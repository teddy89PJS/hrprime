<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SummaryofLates extends Controller
{
  public function index()
  {
    return view('content.pas.summary_of_lates');
  }
}
