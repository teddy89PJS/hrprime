@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Payroll Generation')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="card">
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>List of Payroll Generated</h4>
      <button id="openModalBtn" class="btn btn-success">Generate New Payroll</button>
    </div>

    <div class="table-responsive">
      <table id="payrollTable" class="table">
        <thead class="table-light">
          <tr>
            <th class="text-wrap text-center">Date Requested</th>
            <th class="text-wrap text-center">Period From</th>
            <th class="text-wrap text-center">Period To</th>
            <th class="text-wrap text-center">Fund Cluster</th>
            <th class="text-wrap text-center">Total Net Amount Due</th>
            <th class="text-wrap text-center">Status</th>
            <th class="text-wrap text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($payroll as $index => $payroll)
          <tr data-id="{{ $payroll->id }}">
            <td class="text-wrap text-center">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
            <td class="text-wrap text-center">{{ $payroll->request_date }}</td>
            <td class="text-wrap text-center">{{ $payroll->period_from }}</td>
            <td class="text-wrap text-center">{{ $payroll->period_to }}</td>
            <td class="text-wrap text-center">{{ $payroll->fund_source_id }}</td>
            <td class="text-wrap text-center">{{ $payroll->net_amount_due_total }}</td>
            <td class="text-wrap text-center">{{ $payroll->status }}</td>
            <td class="text-wrap text-center">
              <button
                class="btn btn-sm btn-primary edit-btn "
                data-id="{{ $payroll->id }}"
                data-request_date="{{ $payroll->request_date }}"
                data-period_from="{{ $payroll->period_from }}"
                data-period_to="{{ $payroll->period_to }}"
                data-fund_source_id="{{ $payroll->fund_source_id }}"
                data-net_amount_due_total="{{ $payroll->net_amount_due_total }}"
                data-status="{{ $payroll->status }}">
                Edit
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $payroll->id }}">Delete</button>
              </tdte>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="payrollModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <h5 class="modal-title m-3">Add New Payroll</h5>
      <form id="payrollForm">
        <div class="modal-body">



          <div class="mb-3">
            <label>Period From</label>
            <input type="date" name="period_from" class="form-control" value="{{ old('period_from') }}" required>
          </div>
          <div class="mb-3">
            <label>Period To</label>
            <input type="date" name="period_to" class="form-control" value="{{ old('period_to') }}" required>
          </div>
          <div class="mb-3">
            <label>Fund Cluster</label>
            <select name="fund_source_id" class="form-control form-select" required>
              <option selected value="">Select Fund Cluster</option>
              @foreach($fundsource as $fund_source_name)
              <option value="{{ $fund_source_name->id }}">{{ $fund_source_name->fund_source }}</option>
              @endforeach
            </select>
          </div>
          <!-- Can Add Multiple Employee Names -->
          <div class="mb-3">
            <label>Name</label>
            <select name="employee_name_id" class="form-control form-select" required>
              <option selected value="">Select Employee Name</option>
              @foreach($user as $employeename)
              <option value="{{ $employeename->id }}">{{ $employeename->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label>Position</label>
            <select name="position_id" class="form-control form-select" required>
              <option selected value="">Select Position</option>
              @foreach($position as $positionname)
              <option value="{{ $positionname->id }}">{{ $positionname->abbreviaton }}</option>
              @endforeach
            </select>
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
<div class="modal fade" id="editpayrollModal" tabindex="-1" aria-labelledby="editpayrollModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editpayrollForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editpayrollModalLabel">Edit Fund Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editpayrollId">
          <div class="mb-3">
            <label>Fund Source Name</label>
            <input type="text" name="fund_source" id="editpayrollName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" id="editpayrollDescription" class="form-control" required>
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
    $('#payrollForm')[0].reset();
    var modal = new bootstrap.Modal(document.getElementById('payrollModal'));
    modal.show();
  });
  $('#payrollForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
      url: '{{ route("payroll.store") }}',
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Fund Source Added Successfully!');
          var modal = bootstrap.Modal.getInstance(document.getElementById('payrollModal'));
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

    $('#editpayrollId').val(id);
    $('#editpayrollName').val(fund_source);
    $('#editpayrollDescription').val(description);

    var editModal = new bootstrap.Modal(document.getElementById('editpayrollModal'));
    editModal.show();
  });
  $('#editpayrollForm').submit(function(e) {
    e.preventDefault();

    const id = $('#editpayrollId').val();

    $.ajax({
      url: `/pas/payroll/${id}/update`,
      method: 'POST',
      data: $(this).serialize(),
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          toastr.success('Fund Source Updated Successfully!');
          var editModal = bootstrap.Modal.getInstance(document.getElementById('editpayrollModal'));
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
      url: `/pas/payroll/${deleteId}/delete`,
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
    $('#payrollTable').DataTable({
      paging: true,
      searching: true,
      info: true
    });
  });
</script>

@endpush
