
@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Monthly Leave Credits Summary')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="card">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Leave Credits Summary</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
          <div class="alert alert-warning">{{ session('error') }}</div>
      @endif
    </div>

    <div class="table-responsive">
      <table id="leavecreditsTable" class="table">
      <thead class="table-light">
        <tr>
          <th style="width: 0;">ID No.</th>
          <th>Employee Name</th>
          <th>Vacation Leave</th>
          <th>Sick Leave</th>
          <th>Total Available Leave</th>
        </tr>
      </thead>
      <tbody>
        @foreach($leavecredits as $credit)
        <tr>
          <td>{{ $credit->user->employee_id }}</td>

<td>{{ strtoupper($credit->user->last_name . ', ' . $credit->user->first_name . ' ' . $credit->user->middle_name) }}</td>
          <td>{{ number_format($credit->vacation_leave, 2) }}</td>
          <td>{{ number_format($credit->sick_leave, 2) }}</td>
          <td>{{ number_format($credit->total_leave, 2) }}</td>
          <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
</div>



@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
 $('#leavecreditsTable').DataTable({
  columnDefs: [
    { targets: 0, width: "50px", visible: true, searchable: false }
  ]
});
</script>

@endpush
