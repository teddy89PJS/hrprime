  @php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
  @endphp

  @extends('layouts/contentNavbarLayout')

  @section('title', 'Tables - Basic Tables')

  @section('content')

  @session ('status')
  <div class="alert alert-success">{{session('status')}}</div>
  @endsession

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
            <th><a class="text-white" href="{{ route('fundsource.index', ['sort' => 'fund_source', 'direction' => $sort === 'fund_source' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                Fund Source
                @if ($sort === 'fund_source')
                {!! $direction === 'asc' ? '↑' : '↓' !!}
                @endif
              </a></th>
            <th style="width:60%"><a class="text-white" href="{{ route('fundsource.index', ['sort' => 'description', 'direction' => $sort === 'description' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                Description
                @if ($sort === 'description')
                {!! $direction === 'asc' ? '↑' : '↓' !!}
                @endif
              </a></th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fundsource as $fundsource_item)
          <tr>
            <td>{{ $fundsource_item->fund_source }}</td>
            <td>{{ $fundsource_item->description }}</td>
            <td>
              <a href="{{route('fundsource.show',$fundsource_item->fund_source)}}" class="btn btn-sm btn-info mx-2 my-2"
                data-bs-toggle="modal"
                data-bs-target="#viewModal"
                data-fund_source="{{ $fundsource_item->fund_source }}"
                data-description="{{ $fundsource_item->description }}">
                View
              </a>
              <a href="{{route('fundsource.edit',$fundsource_item->fund_source)}}" class="btn btn-sm btn-warning mx-2 my-2 "
                data-bs-toggle="modal"
                data-bs-target="#editModal"
                data-fund_source="{{ $fundsource_item->fund_source }}"
                data-description="{{ $fundsource_item->description }}">
                Edit
              </a>
              <form action="{{ route('fundsource.destroy', $fundsource_item->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger mx-2 my-2" onclick="return confirm('Are you sure?')">
                  Delete
                </button>
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

  {{-- CREATE MODAL --}}
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('fundsource.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Fund Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Fund Source</label>
            <input type="text" name="fund_source" class="form-control" value="{{old('fund_source')}}" required>
            @error('fund_source') {{$message}} @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
            @error('fund_source') {{$message}} @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>





  {{-- EDIT MODAL --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('fundsource.update', $fundsource_item->fund_source) }}" id="editForm" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Fund Source</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
            <div class="mb-3">
              <input type="text" name="fund_source" id="edit-fund_source" class="form-control" value="{{ $fundsource_item->fund_source }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" id="edit-description" class="form-control">{{old('description') ?? $fundsource_item->description}}</textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
      </form>
    </div>
  </div>


  {{-- VIEW MODAL --}}
  <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel"> Fund Source Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="view-id">
        <div class="mb-3">
          <div class="mb-3">
            <p><strong>Fund Source:</strong> <span id="view-fund_source">{{ $fundsource_item->fund_source }}</span></p>
            <p><strong>Description:</strong> <span id="view-description">{{ $fundsource_item->description }}</span></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>



    @endsection
