@extends('layouts/contentNavbarLayout')

@section('title', 'Employee Registration')

@section('content')
<div class="container mb-4">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Employee Details</h5>
    </div>
    <div class="card-body">

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('employee.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Employee ID</label>
            <input type="text" class="form-control" name="employee_id" value="{{ old('employee_id') }}" required>
          </div>
          <div class="col-md-4">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
          </div>
          <div class="col-md-4">
            <label>Middle Name</label>
            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
          </div>
          <div class="col-md-4">
            <label>Extension Name</label>
            <select class="form-select" name="extension_name">
              <option value="">Choose...</option>
              @foreach(['JR','SR','II','III','IV'] as $ext)
              <option value="{{ $ext }}" {{ old('extension_name') == $ext ? 'selected' : '' }}>{{ $ext }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Employment Status</label>
            <select class="form-select" name="employment_status" required>
              <option value="" disabled selected>Choose...</option>
              @foreach($employmentStatuses as $status)
              <option value="{{ $status->id }}" {{ old('employment_status') == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
              </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Division</label>
            <select class="form-select" name="division" id="divisionSelect" required>
              <option value="" disabled selected>Choose...</option>
              @foreach($divisions as $division)
              <option value="{{ $division->id }}" {{ old('division') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label>Section</label>
            <select class="form-select" name="section" id="sectionSelect" required>
              <option value="">Choose division first...</option>
            </select>
          </div>

          <div class="col-md-4">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
            <small>Min: 6 characters</small>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Register Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- jQuery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    function loadSections(divisionId, selectedSection = null) {
      $('#sectionSelect').empty().append('<option>Loading...</option>');
      $.ajax({
        url: '{{ route("employee.sections") }}',
        type: 'GET',
        data: {
          division_id: divisionId
        },
        success: function(data) {
          $('#sectionSelect').empty().append('<option value="">Choose...</option>');
          $.each(data, function(key, section) {
            $('#sectionSelect').append('<option value="' + section.id + '">' + section.name + '</option>');
          });

          if (selectedSection) {
            $('#sectionSelect').val(selectedSection);
          }
        }
      });
    }

    // Load sections if division was previously selected (after form error)
    const oldDivision = '{{ old("division") }}';
    const oldSection = '{{ old("section") }}';
    if (oldDivision) {
      loadSections(oldDivision, oldSection);
    }

    $('#divisionSelect').on('change', function() {
      const divisionId = $(this).val();
      loadSections(divisionId);
    });
  });
</script>
@endsection
