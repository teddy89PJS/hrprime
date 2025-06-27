
@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fund Source')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="card">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>List of Fund Source</h4>
      <button id="openModalBtn" class="btn btn-success">+ Add New Fund Source</button>
    </div>

    <div class="table-responsive">
      <table id="fundsourceTable" class="table">
        <thead class="table-light">
          <tr>
            <th>No.</th>
            <th>Fund Source</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($fundsources as $index => $fundsource)
          <tr data-id="{{ $fundsource->id }}">
            <td>{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $fundsource->fund_source }}</td>
            <td>{{ $fundsource->description }}</td>
            <td>
              <button
                class="btn btn-sm btn-primary edit-btn"
                data-id="{{ $fundsource->id }}"
                data-fund_source="{{ $fundsource->fund_source }}"
                data-description="{{ $fundsource->description }}">
                Edit
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $fundsource->id }}">Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="fundsourceModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h5 class="modal-title m-3">Add New Fund Source</h5>
      <form id="fundsourceForm">
        <div class="modal-body">
          <div class="mb-3">
            <label>Fund Source Name</label>
            <input type="text" name="fund_source" class="form-control" value="{{ old('fund_source') }}" required>
          </div>
          <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editFundSourceModal" tabindex="-1" aria-labelledby="editFundSourceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editFundSourceForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editFundSourceModalLabel">Edit Fund Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editFundSourceId">
          <div class="mb-3">
            <label>Fund Source Name</label>
            <input type="text" name="fund_source" id="editFundSourceName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" id="editFundSourceDescription" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Delete-->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this fund source?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>



@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
  $('#openModalBtn').click(function() {
    $('#fundsourceForm')[0].reset();
    var modal = new bootstrap.Modal(document.getElementById('fundsourceModal'));
    modal.show();
  });
  $('#fundsourceForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: '{{ route("fundsource.store") }}',
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Fund Source Added Successfully!');
          var modal = bootstrap.Modal.getInstance(document.getElementById('fundsourceModal'));
          modal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to add fund source.");
        }
      },
      error: function(xhr, status, error) {
        console.log("XHR Response: ", xhr.responseText);
        console.log("Status: ", status);
        console.log("Error: ", error);
        toastr.error("Something went wrong: Check console log");
      }
    });

  });
  $(document).on('click', '.edit-btn', function() {
    const id = $(this).data('id');
    const fund_source = $(this).data('fund_source');
    const description = $(this).data('description');

    $('#editFundSourceId').val(id);
    $('#editFundSourceName').val(fund_source);
    $('#editFundSourceDescription').val(description);

    var editModal = new bootstrap.Modal(document.getElementById('editFundSourceModal'));
    editModal.show();
  });
  $('#editFundSourceForm').submit(function(e) {
    e.preventDefault();

    const id = $('#editFundSourceId').val();

    $.ajax({
      url: `/pas/fundsource/${id}/update`,
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Fund Source Updated Successfully!');
          var editModal = bootstrap.Modal.getInstance(document.getElementById('editFundSourceModal'));
          editModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Update Fund Source.");
        }
      },
      error: function(xhr, status, error) {
        console.log("XHR Response: ", xhr.responseText);
        console.log("Status: ", status);
        console.log("Error: ", error);
        toastr.error("Something went wrong: Check console log");
      }
    });
  });
  let deleteId = null;

  $(document).on('click', '.delete-btn', function() {
    deleteId = $(this).data('id');
    var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    deleteModal.show();
  });

  $('#confirmDeleteBtn').click(function() {
    if (!deleteId) return;

    $.ajax({
      url: `/pas/fundsource/${deleteId}/delete`,
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Fund Source Deleted Successfully!');
          var deleteModal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
          deleteModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Delete Fund Source.");
        }
      },
      error: function(xhr, status, error) {
        console.log("XHR Response: ", xhr.responseText);
        console.log("Status: ", status);
        console.log("Error: ", error);
        toastr.error("Something went wrong: Check console log");
      }
    });
  });
</script>
<script>
  jQuery(function($) {
    $('#fundsourceTable').DataTable({
      paging: true,
      searching: true,
      info: true
    });
  });
</script>

@endpush
