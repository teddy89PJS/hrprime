@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard Welfare')

@section('content')

   <!-- Toastr CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container my-25">


    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dashboard Welfare</h1>
        
    </div>

    <!-- Open Nomination Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Open Nomination</h5>
            <p class="card-text">
                Nominations for this year's DSWD Rewards Program are now open! Recognize outstanding individuals or teams who have made significant contributions. 
            </p>
            <a class="btn btn-outline-primary">View Full Details</a>
        </div>
    </div>


@endsection