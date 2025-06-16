@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables', 'user_interface - PaginationBreadcrumbs')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container">
  <div class="card">
    <div class="card-header bg-white">
      <h5 class="mb-0">List of Employees</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="employeeTable" class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>ID No.</th>
              <th>Employee Name</th>
              <th>Position</th>
              <th>Employment Status</th>
              <th>Section</th>
              <th>Division</th>
              <th>Office Location</th>
              <th>SG</th>
              <th>Username</th>
              <th>View Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>001</td>
              <td>Jane Doe</td>
              <td>Software Engineer</td>
              <td>Regular</td>
              <td>IT Services</td>
              <td>Technical Division</td>
              <td>Main Office</td>
              <td>SG 18</td>
              <td>jdoe</td>
              <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
            </tr>
            <tr>
              <td>002</td>
              <td>John Smith</td>
              <td>QA Analyst</td>
              <td>Contractual</td>
              <td>Quality</td>
              <td>Compliance</td>
              <td>Branch Office</td>
              <td>SG 15</td>
              <td>jsmith</td>
              <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
    jQuery(function ($) {
      $('#employeeTable').DataTable({
        paging: true,
        searching: true,
        info: true
      });
    });
  </script>
@endpush
