@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Employee')

@section('content')
<div class="container py-4">
  <div class="card p-4 shadow-sm">
    <h4 class="mb-4">Edit Employee</h4>

    <form method="POST" action="{{ url('/users/' . $employee->id) }}">
      @csrf
      @method('PUT')

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="employee_id" class="form-label">ID No</label>
          <input type="text" name="employee_id" id="employee_id" class="form-control" value="{{ $employee->employee_id }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="{{ $employee->username }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $employee->first_name }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label for="middle_name" class="form-label">Middle Name</label>
          <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $employee->middle_name }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $employee->last_name }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label for="extension_name" class="form-label">Extension</label>
          <input type="text" name="extension_name" id="extension_name" class="form-control" value="{{ $employee->extension_name }}" readonly>
        </div>

        <div class="col-md-4 mb-3">
          <label for="employment_status_id" class="form-label">Employment Status</label>
          <select name="employment_status_id" id="employment_status_id" class="form-select">
            <option value="">-- Select Status --</option>
            @foreach(App\Models\EmploymentStatus::all() as $status)
            <option value="{{ $status->id }}" {{ $employee->employment_status_id == $status->id ? 'selected' : '' }}>
              {{ $status->name }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4 mb-3">
          <label for="division_id" class="form-label">Division</label>
          <select name="division_id" id="division_id" class="form-select">
            <option value="">-- Select Division --</option>
            @foreach(App\Models\Division::all() as $division)
            <option value="{{ $division->id }}" {{ $employee->division_id == $division->id ? 'selected' : '' }}>
              {{ $division->name }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4 mb-3">
          <label for="section_id" class="form-label">Section</label>
          <select name="section_id" id="section_id" class="form-select">
            <option value="">-- Select Section --</option>
            @foreach(App\Models\Section::where('division_id', $employee->division_id)->get() as $section)
            <option value="{{ $section->id }}" {{ $employee->section_id == $section->id ? 'selected' : '' }}>
              {{ $section->name }}
            </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="mt-3">
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="{{ route('employee.view-blade') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#division_id').on('change', function() {
    const divisionId = $(this).val();

    $('#section_id').html('<option value="">-- Loading --</option>');

    if (divisionId) {
      $.ajax({
        url: `/division/${divisionId}/sections`, // ✅ Route should match web.php or api.php
        type: 'GET',
        success: function(sections) {
          let options = '<option value="">-- Select Section --</option>';
          sections.forEach(section => {
            options += `<option value="${section.id}">${section.name}</option>`;
          });
          $('#section_id').html(options);
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error); // Log detailed error
          $('#section_id').html('<option value="">-- Error Loading Section --</option>');
          alert('Error loading sections. Please check console or route.');
        }
      });
    } else {
      $('#section_id').html('<option value="">-- Select Section --</option>');
    }
  });
</script>
@endsection
