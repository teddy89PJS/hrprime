@extends('layouts/contentNavbarLayout')

@section('title', 'Employee List')

@section('content')

<div class="container">
  <div class="card">
    <div class="card-header bg-white">
      <h5 class="mb-0">List of Employees</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="empTable" class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>ID No.</th>
              <th>Employee Name</th>
              <th>Employment Status</th>
              <th>Section</th>
              <th>Division</th>
              <th>Username</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($employees as $employee)
            <tr>
              <td>{{ $employee->employee_id }}</td>
              <td>
                {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} {{ $employee->extension_name }}
              </td>
              <td>{{ $employee->employmentStatus->abbreviation ?? '' }}</td>
              <td>{{ $employee->section->abbreviation ?? '' }}</td>
              <td>{{ $employee->division->abbreviation ?? '' }}</td>
              <td>{{ $employee->username }}</td>
              <td>
                <a href="{{ route('employee.view', $employee->id) }}" class="btn btn-sm btn-primary">View</a>
                <form action="{{ route('employee.delete', $employee->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')

<script>
  $(function() {
    $('#empTable').DataTable({
      paging: true,
      searching: true,
      info: true
    });
  });
</script>
@endpush
