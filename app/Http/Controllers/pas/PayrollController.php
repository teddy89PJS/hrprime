<?php

namespace App\Http\Controllers\pas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
  public function index()
  {
    return view('content.pas.payroll');
  }
}
