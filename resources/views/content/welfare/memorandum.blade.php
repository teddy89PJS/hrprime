@extends('layouts/contentNavbarLayout')

@section('title', 'Archive of Memorandum')

@section('content')

<!-- Toastr CSS -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container my-25">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Archive of Memorandum</h1>
        <button id="addMemorandumBtn" class="btn btn-primary d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Add Memorandum
        </button>
    </div>



    <!-- Search Section -->
        <div class="bg-white rounded shadow p-4 mb-5">
            <div class="row g-4 align-items-end">
                <div class="col-md-6">
                    <label for="searchInput" class="form-label">Search</label>
                    <div class="input-group">
                        <input type="text" id="searchInput" placeholder="Search by subject or issuance number..." class="form-control">
                    </div>
        </div>

        <!-- Group Award Type and Filter Button in the same row -->
        <div class="col-md-6">
            <label for="awardTypeFilter" class="form-label">Award Type</label>
            <div class="d-flex gap-2">
                <select id="awardTypeFilter" class="form-select">
                    <option value="all">All Types</option>
                    <option value="character">Character Building</option>
                    <option value="praise">PRAISE</option>
                </select>
                <button id="filterButton" class="btn btn-primary">Filter</button>
            </div>
            </div>
        </div>
    </div>





    @php 
    ob_start(); 
    @endphp

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">Issuance Number</th>
                <th scope="col">Subject</th>
                <th scope="col" class="text-center">Date of Issuance</th>
                <th scope="col" class="text-center">Notes</th>
                <th scope="col" class="text-center">File</th>
                <th scope="col" class="text-center">Actions</th>
             </tr>
        </thead>
        <tbody id="memorandumTableBody">
    @foreach ($memorandums as $memo)
        <tr>
            <td>{{ $memo->issuance_number }}</td>
            <td>{{ $memo->subject }}</td>
            <td class="text-center">{{ $memo->date_of_issuance }}</td>
            <td class="text-center align-middle" style="max-width: 300px;">
    <div style="display: inline-block; white-space: pre-line; line-height: 0.3;">
        <span style="display: block; margin: 0;">
            {{ Str::limit(strip_tags($memo->notes), 7) }}
        </span>

        @if (Str::length(strip_tags($memo->notes)) > 6)
            <a href="#" class="read-more-link"
               data-notes="{{ e($memo->notes) }}"
               data-bs-toggle="modal"
               data-bs-target="#readMoreModal"
               style="font-size: 0.75rem; display: block; margin-top: 1.5px;">
                Read more
            </a>
        @endif
    </div>
</td>

            <td class="text-center">
                <a href="{{ Storage::url($memo->file_path) }}" target="_blank" class="btn btn-link">
                    <i class="fas fa-file-pdf me-1"></i> View File
                </a>
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm edit-btn"
                        data-id="{{ $memo->id }}"
                        data-issuance_number="{{ $memo->issuance_number }}"
                        data-subject="{{ $memo->subject }}"
                        data-award_type="{{ $memo->award_type }}"
                        data-date="{{ $memo->date_of_issuance }}"
                        data-notes="{{ $memo->notes }}">
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                        data-id="{{ $memo->id }}">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-1">
        <div class="text-muted">
            Showing {{ $memorandums->firstItem() }} to {{ $memorandums->lastItem() }} of {{ $memorandums->total() }} entries
        </div>
        <div>
            {{ $memorandums->links() }}
        </div>
    </div>
    @php 
    $memorandumTable = ob_get_clean(); 
    @endphp


            <!-- Read More Modal -->
        <div class="modal fade" id="readMoreModal" tabindex="-1" aria-labelledby="readMoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readMoreModalLabel">Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-10 py-6">
                <div id="fullNotesContent" style="white-space: pre-wrap; font-family: inherit; text-align: justify;"></div>
            </div>
            </div>
        </div>
        </div>



    <!-- Add Memorandum Modal -->
            <div class="modal fade" id="addMemorandumModal" tabindex="-1" aria-labelledby="addMemorandumModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('memorandums.store') }}" enctype="multipart/form-data" class="modal-content" id="memorandumForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemorandumModalLabel">Add Memorandum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                    <div class="mb-3">
                        <label 
                            for="issuance_number" class="form-label">Issuance Number <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="issuance_number" required>
                    </div>
                    <div class="mb-3">
                <label for="subject" class="form-label">
                Subject <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="subject" required>
            </div>

            <div class="mb-3">
                <label for="award_type" class="form-label">
                Award Type <span class="text-danger">*</span>
                </label>
                <select name="award_type" class="form-select" required>
                <option value="character">Character Building</option>
                <option value="praise">PRAISE</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_of_issuance" class="form-label">
                Date of Issuance <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" name="date_of_issuance" required>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">
                Upload PDF <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control" name="file" accept=".pdf" required>
                <small class="text-muted">Max size: 5MB</small>
            </div>

                    <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Memorandum</button>
                </div>
                </form>
            </div>
            </div>



        <!-- Edit Memorandum Modal -->
                <div class="modal fade" id="editMemorandumModal" tabindex="-1" aria-labelledby="editMemorandumModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="" enctype="multipart/form-data" class="modal-content" id="editMemorandumForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMemorandumModalLabel">Edit Memorandum</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">

                        <div class="mb-3">
                        <label for="edit_issuance_number" class="form-label">Issuance Number</label>
                        <input type="text" class="form-control" name="issuance_number" id="edit_issuance_number" required>
                        </div>

                        <div class="mb-3">
                        <label for="edit_subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="edit_subject" required>
                        </div>

                        <div class="mb-3">
                        <label for="edit_award_type" class="form-label">Award Type</label>
                        <select name="award_type" id="edit_award_type" class="form-select" required>
                            <option value="character">Character Building</option>
                            <option value="praise">PRAISE</option>
                        </select>
                        </div>

                        <div class="mb-3">
                        <label for="edit_date" class="form-label">Date of Issuance</label>
                        <input type="date" class="form-control" name="date_of_issuance" id="edit_date" required>
                        </div>

                        <div class="mb-3">
                        <label for="edit_notes" class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" id="edit_notes" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                        <label for="edit_file" class="form-label">Replace PDF File</label>
                        <input type="file" class="form-control" name="file" id="edit_file" accept=".pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Memorandum</button>
                    </div>
                    </form>
                </div>
                </div>


                <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" class="modal-content" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this Memorandum?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </div>
                        </form>
                    </div>
                    </div>

    <!-- Memorandum List Section -->
    <div class="bg-white rounded shadow overflow-hidden">
        <div class="table-responsive">
            {!! $memorandumTable !!}
        </div>
    </div>
</div>



@push('scripts')

<!-- jQuery (required for Toastr, skip if already included in layout) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- ✅ Toastr Notifications -->
@if (session('success'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ session('success') }}");
        });
    </script>

@endif

<!-- Main Scripts -->
<script>


    // ✅ All jQuery-related logic
    $(function () {
        // Show Add Memorandum modal
        $('#addMemorandumBtn').on('click', function () {
            $('#addMemorandumModal').modal('show');
        });

        // Reset form when modal is hidden
        $('#addMemorandumModal').on('hidden.bs.modal', function () {
            $('#memorandumForm')[0].reset();
        });

        // AJAX filtering and searching
        function fetchMemorandums() {
            let search = $('#searchInput').val();
            let awardType = $('#awardTypeFilter').val();
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

            $.ajax({
                url: "{{ route('welfare.memorandum') }}",
                type: "GET",
                data: {
                    search: search,
                    award_type: awardType,
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (data) {
                    $('#memorandumTableBody').html($(data).find('#memorandumTableBody').html());
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr);
                    alert('Could not fetch data: ' + error);
                }
            });
        }

        $('#searchInput, #awardTypeFilter, #startDate, #endDate').on('change keyup', fetchMemorandums);

        const updateUrlTemplate = "{{ route('memorandum.update', ['id' => '__ID__']) }}";
        const deleteUrlTemplate = "{{ route('memorandums.destroy', ['id' => '__ID__']) }}";

        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');
            const form = $('#editMemorandumForm');

            form.attr('action', updateUrlTemplate.replace('__ID__', id));
            $('#edit_id').val(id);
            $('#edit_issuance_number').val($(this).data('issuance_number'));
            $('#edit_subject').val($(this).data('subject'));
            $('#edit_award_type').val($(this).data('award_type'));
            $('#edit_date').val($(this).data('date'));
            $('#edit_notes').val($(this).data('notes'));

            $('#editMemorandumModal').modal('show');
        });

        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');
            $('#deleteForm').attr('action', deleteUrlTemplate.replace('__ID__', id));
            $('#deleteConfirmationModal').modal('show');
        });

    // Read More functionality
        $(document).on('click', '.read-more-link', function (e) {
            e.preventDefault();
            const fullNotes = $(this).data('notes');
            $('#fullNotesContent').text('· ' + fullNotes);
        });

    });
</script>
@endpush


@endsection