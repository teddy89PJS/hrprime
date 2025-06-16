<?php

namespace App\Http\Controllers\layouts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationFormController extends Controller
{
  public function index()
  {

    return view('content.hrplanning.layouts-registration-form');
  }
}
