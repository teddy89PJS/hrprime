<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportPayroll extends Controller
{
  public function index()
  {
    return view('content.pas.import_payroll');
  }
}
