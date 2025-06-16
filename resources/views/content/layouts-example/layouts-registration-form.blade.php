@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<div class="container mb-4">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Employee Details</h5>
    </div>
    <div class="card-body">
      <form action="{{ url('/register-employee') }}" method="POST">
        @csrf
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="employee_id" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="employee_id" name="employee_id" required>
          </div>
          <div class="col-md-4">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          <div class="col-md-4">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>
          <div class="col-md-4">
            <label for="extension_name" class="form-label">Extension Name</label>
            <select class="form-select" id="extension_name" name="extension_name" required>
              <option value="" disabled selected>Choose...</option>
              <option value="JR">JR</option>
              <option value="SR">SR</option>
              <option value="II">II</option>
              <option value="III">III</option>
              <option value="IV">IV</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="employment_status" class="form-label">Employment Status</label>
            <select class="form-select" id="employment_status" name="employment_status" required>
              <option value="" disabled selected>Choose...</option>
              <option value="Contractual">Contractual</option>
              <option value="Permanent">Permanent</option>
              <option value="Casual">Casual</option>
              <option value="Coterminous">Coterminous</option>
              <option value="MOA">MOA</option>
              <option value="Job Order">Job Order</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="division" class="form-label">Division</label>
            <input type="text" class="form-control" id="division" name="division" required>
          </div>
          <div class="col-md-4">
            <label for="section" class="form-label">Section</label>
            <input type="text" class="form-control" id="section" name="section" required>
          </div>
          <div class="col-md-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Register Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
