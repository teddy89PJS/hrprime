<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewPasswordController extends Controller
{
  public function create(Request $request, $token)
  {
    return view('auth.reset-password', [
      'token' => $token,
      'email' => $request->email
    ]);
  }

  public function store(Request $request)
  {
    // handle actual password update here
  }
}
