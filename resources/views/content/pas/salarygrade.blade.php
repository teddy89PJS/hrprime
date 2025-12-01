@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Salary Grade')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />


<div class="card">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>List of Salary Grades</h4>
      <button id="openModalBtn" class="btn btn-success">Add New Salary Grade</button>
    </div>

    <div class="table-responsive">
      <table id="salarygradeTable" class="table">
        <thead class="table-light">
          <tr>
            <!-- <th class="text-wrap text-center">No</th> -->
            <th class="text-wrap text-center">Salary Grade</th>
            <th class="text-wrap text-center">Cost of Service Base Rate (PhP)</th>
            <th class="text-wrap text-center">Premium Rate (%)</th>
            <th class="text-wrap text-center">Premium Amount (PhP)</th>
            <th class="text-wrap text-center">Base Rate + Premium (PhP)</th>
            <th class="text-wrap text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($salarygrades as $index => $salarygrades)
            <tr data-id="{{ $salarygrades->id }}" >
              <!-- <td class="text-center">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td> -->
              <td class="text-center">{{ $salarygrades->sg_num }}</td>
              <td class="text-center">₱ {{ number_format($salarygrades->base_rate, 2) }}</td>
              <td class="text-center">{{ $salarygrades->premium_rate }}%</td>
              <td class="text-center">₱ {{ number_format($salarygrades->premium_amount, 2) }}</td>
              <td class="text-center">₱ {{ number_format($salarygrades->total_amount, 2) }}</td>

                <td class=" text-center mx-auto">
                  <button
                    class="m-1 btn btn-sm btn-primary edit-btn"
                    data-id="{{ $salarygrades->id }}"
                    data-sg_num="{{ $salarygrades->sg_num }}"
                    data-base_rate="{{ $salarygrades->base_rate }}"
                    data-premium_rate="{{ $salarygrades->premium_rate }}">
                    Edit
                  </button>
                  <button class="m-1 btn btn-sm btn-danger delete-btn" data-id="{{ $salarygrades->id }}">Delete</button>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="salarygradeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <h5 class="modal-title m-3">Add New Salary Grade</h5>
      <form id="salarygradeForm">
        <div class="modal-body">

          <div class="mb-3">
            <label>Salary Grade</label>
            <input type="number" name="sg_num" class="form-control" min="1" max="27" oninput="this.value = this.value.slice(0, 2);" placeholder="e.g. 1, 2, 3" value="{{ old('sg_num') }}" required>
          </div>
          <div class="mb-3">
            <label>Cost of Service Base Rate</label>
            <input type="number" name="base_rate" class="form-control" placeholder="e.g. 99,999"  value="{{ old('base_rate') }}" required>
          </div>
          <div class="mb-3">
            <label>Premium Rate in Percent</label>
            <input type="number" name="premium_rate" class="form-control" placeholder="e.g. 9.99" value="{{ old('premium_rate') }}" step="any" required>
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
<div class="modal fade" id="editsalarygradeModal" tabindex="-1" aria-labelledby="editsalarygradeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editsalarygradeForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editsalarygradeModalLabel">Edit Salary Grade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editsalarygradeId">
           <div class="mb-3">
            <label>Salary Grade</label>
            <input type="number" name="sg_num" id="editsalarygrade" class="form-control" value="{{ old('sg_num') }}" required>
          </div>
          <div class="mb-3">
            <label>Cost of Service Base Rate</label>
            <input type="number" name="base_rate" id="editcostofservicerate" class="form-control" value="{{ old('base_rate') }}" required>
          </div>
          <div class="mb-3">
            <label>Premium Rate in Percent</label>
            <input type="number" name="premium_rate" id="editpremiumrate" class="form-control" value="{{ old('premium_rate') }}" step="any" required>
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
        Are you sure you want to delete this salary grade?
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
      $('#salarygradeForm')[0].reset();
      var modal = new bootstrap.Modal(document.getElementById('salarygradeModal'));
      modal.show();
  });
    $('#salarygradeForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: '{{ route("salarygrade.store") }}',
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Salary Grade Added Successfully!');
          var modal = bootstrap.Modal.getInstance(document.getElementById('salarygradeModal'));
          modal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to add salary grade.");
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
    const sg_num = $(this).data('sg_num');
    const base_rate = $(this).data('base_rate');
    const premium_rate = $(this).data('premium_rate');

    $('#editsalarygradeId').val(id);
    $('#editsalarygrade').val(sg_num);
    $('#editcostofservicerate').val(base_rate);
    $('#editpremiumrate').val(premium_rate);

     // Update readonly Premium Amount display
    const premium_amount = (base_rate * premium_rate) / 100;
    $('#editpremiumamount').val(premium_amount);

    var editModal = new bootstrap.Modal(document.getElementById('editsalarygradeModal'));
    editModal.show();
  });

  $('#editsalarygradeForm').submit(function(e) {
    e.preventDefault();

    const id = $('#editsalarygradeId').val();

    $.ajax({
      url: `/pas/salarygrade/${id}/update`,
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Salary Grade Updated Successfully!');
          var editModal = bootstrap.Modal.getInstance(document.getElementById('editsalarygradeModal'));
          editModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Update Salary Grade.");
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
      url: `/pas/salarygrade/${deleteId}/delete`,
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Salary Grade Deleted Successfully!');
          var deleteModal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
          deleteModal.hide();
          setTimeout(() => location.reload(), 500);
        } else {
          toastr.error("Failed to Delete Salary Grade.");
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
    $('#salarygradeTable').DataTable({
      paging: true,
      searching: true,
      info: true
    });
  });
</script>

 @endpush

