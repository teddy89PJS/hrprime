<h5 class="mb-3">TEMPLATE I - DATABASE OF APPROVED REQUESTS FOR CREATION, EXTENSION AND ABOLITION OF COS AND JO POSITIONS</h5>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Subject</th>
      <th>Position</th>
      <th>Section</th>
      <th>Fund Source</th>
      <th>No. of Positions</th>
      <th>Effectivity Date</th>
      <th>Remarks</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse($employees as $req)
    <tr>
      <td>{{ $req->id }}</td>
      <td>{{ $req->subject }}</td>
      <td>{{ $req->position_name }}</td>
      <td>{{ $req->section->name ?? 'N/A' }}</td>
      <td>{{ $req->fundSource->fund_source ?? 'N/A' }}</td>
      <td>{{ $req->no_of_position }}</td>
      <td>{{ \Carbon\Carbon::parse($req->effectivity_of_position)->format('Y-m-d') }}</td>
      <td>{{ $req->remarks }}</td>
      <td><span class="badge bg-success">{{ ucfirst($req->status) }}</span></td>
    </tr>
    @empty
    <tr>
      <td colspan="9" class="text-center">No approved JO requests found.</td>
    </tr>
    @endforelse
  </tbody>
</table>
@if($employees->count())
<a href="{{ route('planning.reports.export', ['type' => 'database-creations']) }}" class="btn btn-outline-primary mt-3">Export to Excel</a>
@endif
