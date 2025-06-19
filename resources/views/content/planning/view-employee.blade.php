@extends('layouts/contentNavbarLayout')

@section('title', 'View Employee')

@section('content')
<div class="container py-4">

  <a href="{{ route('employee.list') }}" class="btn btn-secondary mb-3">
    ← Back to Employee List
  </a>

  <div class="card">
    <div class="card-header">
      <h4 class="mb-0">Employee Details</h4>
    </div>

    <div class="card-body">
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      <form>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>ID No.</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" value="{{ $employee->employee_id }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>Full Name</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext"
              value="{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} {{ $employee->extension_name }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>Username</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" value="{{ $employee->username }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>Employment Status</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext"
              value="{{ $employee->employmentStatus->abbreviation ?? '-' }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>Section</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext"
              value="{{ $employee->section->abbreviation ?? '-' }}">
          </div>
        </div>

        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"><strong>Division</strong></label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext"
              value="{{ $employee->division->abbreviation ?? '-' }}">
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <a href="{{ url('/employee/' . $employee->id . '/edit') }}" class="btn btn-primary">Edit</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection