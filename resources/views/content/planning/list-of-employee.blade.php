@extends('layouts/contentNavbarLayout')

@section('title', 'Employee List')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="card">
  <div class="container py-4">
    <h4 class="mb-3">List of Employees</h4>
    <div class="table-responsive">
    <table id="empTable" class="table">
        <thead class="table-light">
          <tr>
            <th>ID No.</th>
            <th>Employee Name</th>
            <th>Employment Status</th>
            <th>Section</th>
            <th>Division</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($employees as $employee)
          <tr>
            <td>{{ $employee->employee_id }}</td>
            <td>{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} {{ $employee->extension_name }}</td>
            <td>{{ $employee->employmentStatus->abbreviation ?? '' }}</td>
            <td>{{ $employee->section->abbreviation ?? '' }}</td>
            <td>{{ $employee->division->abbreviation ?? '' }}</td>
            <td>{{ $employee->username }}</td>
            <td>
              <a href="{{ route('employee.view', $employee->id) }}" class="btn btn-sm btn-primary">View</a>
              <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $employee->id }}">Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@push('scripts')
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  $(document).ready(function() {
    $('#empTable').DataTable(); // Enables pagination, filtering, search
  });
</script>
@endpush
