<?php

namespace App\Http\Controllers\planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Reports extends Controller
{
  public function index()
  {
    return view('content.planning.reports');
  }
}
