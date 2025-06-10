@extends('layouts.blankLayout')

@section('title', 'Reset Password')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6 mx-4">

      <!-- Reset Password Card -->
      <div class="card p-7">

        <div class="card-body mt-1">
          <h4 class="mb-1">Reset Your Password 🔐</h4>
          <p class="mb-4">Enter your new password below to reset your account password.</p>

          @if ($errors->any())
          <div class="alert alert-danger text-center">
            {{ $errors->first() }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-floating form-floating-outline mb-4">
              <input type="password" class="form-control" name="password" placeholder="New password" required autofocus>
              <label for="password">New Password</label>
            </div>

            <div class="form-floating form-floating-outline mb-4">
              <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
              <label for="password_confirmation">Confirm Password</label>
            </div>

            <button class="btn btn-primary d-grid w-100 mb-4">Reset Password</button>
          </form>

          <div class="text-center">
            <a href="{{ url('auth/login-basic') }}" class="d-flex align-items-center justify-content-center">
              <i class="ri-arrow-left-s-line ri-20px me-1_5"></i> Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Reset Password Card -->

    </div>
  </div>
</div>
@endsection