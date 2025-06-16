<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeLocationController extends Controller
{
  public function index()
  {

    return view('content.hrplanning.layouts-office-location');
  }
}
