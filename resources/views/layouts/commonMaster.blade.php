<!DOCTYPE html>
<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') | Materio - HTML Laravel Free Admin Template </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  @include('layouts/sections/styles')
  @yield('vendor-style')
  @include('layouts/sections/scriptsIncludes') {{-- These are generally safe in head --}}
</head>

<body>

  @yield('layoutContent')
  {{-- This section MUST load jQuery and other core template libraries first. --}}
  @include('layouts/sections/scripts')
  {{-- This section MUST load AFTER jQuery from your core scripts, but BEFORE your custom page scripts. --}}
  @yield('vendor-script')
  {{-- This section MUST load LAST, after all libraries are available. --}}
  @yield('page-script')
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
