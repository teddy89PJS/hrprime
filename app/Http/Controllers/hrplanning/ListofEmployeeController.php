<?php

namespace App\Http\Controllers\hrplanning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListofEmployeeController extends Controller
{
  public function index()
  {

    return view('content.hrplanning.layouts-list-of-employee');
  }
}
