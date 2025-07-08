@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard Welfare')

@section('content')

    <!-- Highlighted Award Recipients Carousel -->
    <div class="mb-4">
        @php
            // Fiscal year starts in October; adjust as needed
            $currentMonth = date('n');
            $fiscalYear = $currentMonth >= 10 ? date('Y') + 1 : date('Y');
        @endphp
        <h5>Highlighted Award Recipients (Fiscal Year {{ $fiscalYear }})</h5>
        <div id="awardRecipientsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($awardRecipients as $index => $recipient)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="d-flex align-items-center">
                            <img src="{{ $recipient->photo_url }}" class="rounded-circle me-3" alt="{{ $recipient->name }}" width="80" height="80">
                            <div>
                                <h6 class="mb-1">{{ $recipient->name }}</h6>
                                <p class="mb-0">{{ $recipient->award_title }}</p>
                                <small class="text-muted">{{ $recipient->department }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#awardRecipientsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#awardRecipientsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Open Nomination Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Open Nomination</h5>
            <p class="card-text">
                Nominations for this year's DSWD Rewards Program are now open! Recognize outstanding individuals or teams who have made significant contributions. 
            </p>
            <a href="{{ route('welfare.nominations.details') }}" class="btn btn-outline-primary">View Full Details</a>
        </div>
    </div>


@endsection