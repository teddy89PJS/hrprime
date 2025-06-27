@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp


@extends('layouts/contentNavbarLayout')

@section('title', 'Import Payroll')

@section('content')
<div class="card">
  <div class="container py-4">
    <div class="justify-content-between align-items-center mb-3">
      <h4>Import Payroll</h4>
      <h5 class="text-center text-danger">Reminders Before Importing Payroll</h5>
      <div class="container  ">
        <div class="row">
        <li class="col-6 col-sm-3">Ensure the file is in <b>CSV format</b> before uploading.</li>
        <li class="col-6 col-sm-3">Check that all required columns are present in the file.</li>
        <li class="col-6 col-sm-3">Do not close the page while the process is running.</li></div>
        </div>
      <div class="row justify-content-center">
    <div class="col-4">
      One of two columns
    </div>
    <div class="col-4">
      One of two columns
    </div>

  </div>
</div>

</>@endsection
