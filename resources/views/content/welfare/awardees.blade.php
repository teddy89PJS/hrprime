@extends('layouts/contentNavbarLayout')

@section('title', 'Awardees')

@section('content')

<!-- Toastr CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container my-25">


    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Archive of Awardees</h1>
        <button id="addMemorandumBtn" class="btn btn-primary d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Add Memorandum
        </button>
    </div>

    