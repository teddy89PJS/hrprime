@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<div class="container mt-4">
  <h4 class="mb-3">Employee Table</h4>
  <div class="table-responsive">
    <table class="table table-bordered">
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
        {{-- Example row --}}
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
        {{-- Add more rows dynamically here --}}
      </tbody>
    </table>
  </div>
</div>
