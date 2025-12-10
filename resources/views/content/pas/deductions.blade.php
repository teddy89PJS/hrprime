@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Deductions')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />


<div class="card">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>List of Deductions</h4>
      <button id="openModalBtn" class="btn btn-success">Add New Deduction</button>
    </div>

    <div class="table-responsive">
      <table id="deductionTable" class="table">
        <thead class="table-light">
          <tr>
            <!-- <th class="text-wrap text-center">No</th> -->
            <th class="text-wrap text-center">Name of Deduction</th>
            <th class="text-wrap text-center">Deduction Amount</th>
            <th class="text-wrap text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($deductions as $index => $deductions)
          <tr data-id="{{ $deductions->id }}">
            <!-- <td class="text-center">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td> -->
            <td class="text-center">{{ $deductions->deduction_name }}</td>
            <td class="text-center">₱ {{ number_format($deductions->deduction_amount, 2) }}</td>

            <td class=" text-center text-wrap">
              <button
                class="m-1 btn btn-sm btn-primary edit-btn"
                data-id="{{ $deductions->id }}"
                data-deduction_name="{{ $deductions->deduction_name }}"
                data-deduction_amount="{{ $deductions->deduction_amount }}">
                Edit
              </button>
              <button class="m-1 btn btn-sm btn-danger delete-btn" data-id="{{ $deductions->id }}">Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="deductionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h5 class="modal-title m-3">Add New Deduction</h5>
      <form id="deductionForm">
        <div class="modal-body">

          <div class="mb-3">
            <label>Deduction Name </label>
            <input type="text" name="deduction_name" class="form-control" placeholder="Input Deduction Name" value="{{ old('deduction_name') }}" required>
          </div>
          <div class="mb-3">
            <label>Deduction Amount</label>
            <input type="number" name="deduction_amount" class="form-control" placeholder="e.g. 99,999" value="{{ old('deduction_amount') }}" required>
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
<div class="modal fade" id="editdeductionModal" tabindex="-1" aria-labelledby="editdeductionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editdeductionForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editdeductionModalLabel">Edit Deduction </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editdeductionId">
          <div class="mb-3">
            <label>Deduction Name </label>
            <input type="text" name="deduction_name" id="editdeductionname" class="form-control" value="{{ old('deduction_name') }}" required>
          </div>
          <div class="mb-3">
            <label>Deduction Amount</label>
            <input type="number" name="deduction_amount" id="editdeductionamount" class="form-control" value="{{ old('deduction_amount') }}" required>
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

<!--Delete Modal-->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Deduction?
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
    $('#deductionForm')[0].reset();
    var modal = new bootstrap.Modal(document.getElementById('deductionModal'));
    modal.show();
  });
  $('#deductionForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: '{{ route("deductions.store") }}',
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Deduction Added Successfully!');
          var modal = bootstrap.Modal.getInstance(document.getElementById('deductionModal'));
          modal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to add deduction.");
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
    const deduction_name = $(this).data('deduction_name');
    const deduction_amount = $(this).data('deduction_amount');

    $('#editdeductionId').val(id);
    $('#editdeductionname').val(deduction_name);
    $('#editdeductionamount').val(deduction_amount);

    var editModal = new bootstrap.Modal(document.getElementById('editdeductionModal'));
    editModal.show();
  });
  $('#editdeductionForm').submit(function(e) {
    e.preventDefault();

    const id = $('#editdeductionId').val();

    $.ajax({
      url: `/pas/deductions/${id}/update`,
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Deduction Updated Successfully!');
          var editModal = bootstrap.Modal.getInstance(document.getElementById('editdeductionModal'));
          editModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Update Deduction.");
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
      url: `/pas/deductions/${deleteId}/delete`,
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Deduction Deleted Successfully!');
          var deleteModal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
          deleteModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Delete Deduction.");
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
    $('#deductionTable').DataTable({
      paging: true,
      searching: true,
      info: true
    });
  });
</script>
@endpush
