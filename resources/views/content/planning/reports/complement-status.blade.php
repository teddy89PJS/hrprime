<h5 class="mb-3">TEMPLATE B - COMPLEMENT PER STATUS OF EMPLOYMENT AND PER PROGRAM, ACTIVITY, PROJECT (ACTUAL POSITIONS IN YOUR REGION)</h5>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Program / Section</th>
      @foreach($statuses as $status)
      <th>{{ $status->name }}</th>
      @endforeach
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sections as $section)
    <tr>
      <td class="text-start">{{ $section->name }}</td>
      @php $rowTotal = 0; @endphp
      @foreach($statuses as $status)
      @php
      $count = $data[$section->id][$status->id] ?? 0;
      $rowTotal += $count;
      @endphp
      <td>{{ $count }}</td>
      @endforeach
      <td class="fw-bold">{{ $rowTotal }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@if(!empty($employees))
<a href="{{ route('planning.reports.export', ['type' => 'personnel-status']) }}" class="btn btn-outline-primary mt-3">Export to Excel</a>
@endif
