<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListofEmployee extends Controller
{
  public function index()
  {

    return view('content.layouts-example.layouts-list-of-employee');
  }
}
