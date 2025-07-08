@extends('layouts/contentNavbarLayout')

@section('title', 'Hall of Awardees')

@section('content')

<!-- Toastr CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container my-25">


    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Hall of Awardees</h1>
        <button id="addAwardBtn" class="btn btn-primary d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Add Awardees
        </button>
    </div>

@endsection
    