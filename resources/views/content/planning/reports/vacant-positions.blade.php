<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<h5 class="mb-3">TEMPLATE B - VACANT POSITIONS (INACTIVE STATUS)</h5>

<table id="positionTable" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Position Title</th>
      <th>Item No.</th>
      <th>Salary Grade</th>
      <th>Employment Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse($positions as $position)
    <tr>
      <td>{{ $position->position_name }}</td>
      <td>{{ $position->item_no }}</td>
      <td>{{ $position->salaryGrade->sg_num ?? '-' }}</td>
      <td>{{ $position->employmentStatus->name ?? '-' }}</td>
    </tr>
    @empty
    <tr>
      <td colspan="5" class="text-center text-muted">No vacant positions found.</td>
    </tr>
    @endforelse
  </tbody>
</table>

@if(!empty($positions))
<a href="{{ route('planning.reports.export', ['type' => 'vacant-positions']) }}" class="btn btn-outline-primary mt-3">Export to Excel</a>
@endif
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  $('#positionTable').DataTable();
</script>
@endpush
