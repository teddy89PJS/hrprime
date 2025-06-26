@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Qualifications')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="card mt-4">
  <div class="card-body">
    <h4 class="mb-4">Manage Qualifications</h4>

    <!-- Success Alert -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Add Qualification Form -->
    <form method="POST" action="{{ route('qualifications.store') }}" class="mb-4 row g-3 align-items-center">
      @csrf
      <div class="col-auto flex-grow-1">
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter qualification title" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success">Add Qualification</button>
      </div>
    </form>

    <!-- List of Qualifications -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Qualification Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($qualifications as $qualification)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $qualification->title }}</td>
              <td>
                <form method="POST" action="{{ route('qualifications.destroy', $qualification->id) }}"
                      onsubmit="return confirm('Are you sure you want to delete this qualification?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center">No qualifications found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  @if(session('success'))
    toastr.success("{{ session('success') }}");
  @endif
</script>
@endpush
