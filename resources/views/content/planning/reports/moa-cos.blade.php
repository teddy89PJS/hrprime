<h5 class="mb-3">TEMPLATE E - MONITORING OF VACANT (PERMANENT, COTERMINOUS, CASUAL, CONTRACTUAL, COS) POSITIONS FOR FILLING UP</h5>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Full Name</th>
      <th>Status</th>
      <th>Division</th>
      <th>Section</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees ?? [] as $employee)
    <tr>
      <td>{{ $employee->employee_id }}</td>
      <td>{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} {{ $employee->extension_name }}</td>
      <td>{{ $employee->employmentStatus->name ?? '-' }}</td>
      <td>{{ $employee->division->name ?? '-' }}</td>
      <td>{{ $employee->section->name ?? '-' }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@if(!empty($employees))
<a href="{{ route('planning.reports.export', ['type' => 'personnel-status']) }}" class="btn btn-outline-primary mt-3">Export to Excel</a>
@endif
