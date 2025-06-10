<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255|unique:users,name',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6',
      'terms' => 'accepted'
    ]);

    User::create([
      'name' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    // Redirect to login page instead of logging in
    return redirect()->route('auth-login-basic')->with('success', 'Registration successful. Please log in.');
  }
}
