@extends('layouts/contentNavbarLayout')

@section('title', 'Fund Sources')

@section('content')

@if (session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif

<h1 class="mb-4">Fund Sources</h1>

<div class="card p-2">
  <div class="mb-3">
    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">+ Add Fund Source</button>
  </div>

  @if($fundsource->isEmpty())
  <p>No Fund Sources Found.</p>
  @else
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Fund Source</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fundsource as $item)
        <tr>
          <td>{{ $item->fund_source }}</td>
          <td>{{ $item->description }}</td>
          <td>
            <button class="btn btn-sm btn-secondary edit-button"
              data-id="{{ $item->id }}"
              data-fund_source="{{ $item->fund_source }}"
              data-description="{{ $item->description }}"
              data-bs-toggle="modal" data-bs-target="#editModal">View</button>

            <form action="{{ route('fundsource.destroy', $item->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="float-end mt-2">{{ $fundsource->links() }}</div>
  </div>
  @endif
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('fundsource.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Add Fund Source</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Fund Source</label>
          <input type="text" name="fund_source" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Description</label>
          <textarea name="description" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Fund Source</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id">
        <div class="mb-3">
          <label>Fund Source</label>
          <input type="text" name="fund_source" id="edit-fund_source" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Description</label>
          <textarea name="description" id="edit-description" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('.edit-button').click(function() {
      const id = $(this).data('id');
      const fund_source = $(this).data('fund_source');
      const description = $(this).data('description');

      $('#edit-fund_source').val(fund_source);
      $('#edit-description').val(description);
      $('#editForm').attr('action', '/pas/fundsource/' + id);
    });
  });
</script>

@endsection
