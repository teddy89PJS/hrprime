<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
  public function sendResetLinkEmail(Request $request)
  {
    // Validate input
    $request->validate([
      'email' => 'required|email',
    ]);

    // Attempt to send the reset link to the user's email
    $status = Password::sendResetLink(
      $request->only('email')
    );

    // Return response
    return $status === Password::RESET_LINK_SENT
      ? back()->with('status', __($status))
      : back()->withErrors(['email' => __($status)]);
  }
}
