<?php

namespace App\Http\Controllers\planning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListofEmployee extends Controller
{
  public function index()
  {

    return view('content.planning.list-of-employee');
  }
}
