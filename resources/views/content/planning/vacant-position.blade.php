@extends('layouts/contentNavbarLayout')

@section('title', 'Open Positions')

@section('content')
<div class="card">
  <div class="container py-4">
    <h4 class="mb-4">Vacant Positions</h4>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Position Title</th>
            <th>Required Qualification</th>
            <th>Qualified Staff</th>
          </tr>
        </thead>
        <tbody>
          @forelse($vacantPositions as $position)
          <tr>
            <td>{{ $position->title }}</td>
            <td>{{ $position->qualification->qualification_name ?? 'Not Set' }}</td>
            <td>
              @if($position->qualifiedStaff->count())
                <ul>
                  @foreach($position->qualifiedStaff as $staff)
                    <li>{{ $staff->first_name }} {{ $staff->last_name }}</li>
                  @endforeach
                </ul>
              @else
                <span class="text-muted">No qualified staff</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center text-muted">No vacant positions found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
