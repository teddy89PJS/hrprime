<?php

namespace App\Http\Controllers\hrplanning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
  public function index()
  {

    return view('content.hrplanning.layouts-division');
  }
}
