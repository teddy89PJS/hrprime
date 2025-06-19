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
        <tbody></tbody>
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
  $('#empTable').DataTable({
    ajax: {
      url: '/api/employees',
      dataSrc: ''
    },
    columns: [{
        data: 'employee_id'
      },
      {
        data: null,
        render: function(data) {
          return `${data.first_name} ${data.middle_name ?? ''} ${data.last_name} ${data.extension_name ?? ''}`.replace(/\s+/g, ' ').trim();
        }
      },
      {
        data: 'employmentStatus.abbreviation',
        defaultContent: ''
      },
      {
        data: 'section.abbreviation',
        defaultContent: ''
      },
      {
        data: 'division.abbreviation',
        defaultContent: ''
      },
      {
        data: 'username'
      },
      {
        data: null,
        render: function(data) {
          return `
    <a href="/employee/view/${data.id}" class="btn btn-sm btn-primary">View</a>
    <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id}">Delete</button>
  `;
        }
      }
    ]
  });
</script>
@endpush