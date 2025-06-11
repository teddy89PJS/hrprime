<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
  public function showResetForm(Request $request, $token)
  {
    return view('content.authentications.reset-password', [
      'token' => $token,
      'email' => $request->query('email'),
    ]);
  }

  public function reset(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user) use ($request) {
        $user->forceFill([
          'password' => Hash::make($request->password),
        ])->save();
      }
    );

    return $status === Password::PASSWORD_RESET
      ? redirect()->route('auth-login-basic')->with('status', __($status))
      : back()->withErrors(['email' => [__($status)]]);
  }
}
