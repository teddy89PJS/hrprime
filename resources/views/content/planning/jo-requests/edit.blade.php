@extends('layouts/contentNavbarLayout')

@section('title', 'Edit JO Request')

@section('content')
<div class="container py-4">
  <h4 class="mb-4">Edit JO Request</h4>

  <form method="POST" action="{{ route('planning.jo-requests.update', $joRequest->id) }}">
    @csrf
    @method('PATCH')

    <div class="row g-3">


      <div class="col-md-12">
        <label class="form-label">Subject</label>
        <input type="text" name="subject" value="{{ $joRequest->subject }}" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Request Type</label>
        <select name="type" class="form-select" required>
          <option value="CMF" {{ $joRequest->type == 'CMF' ? 'selected' : '' }}>CMF</option>
          <option value="DR" {{ $joRequest->type == 'DR' ? 'selected' : '' }}>DR</option>
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label">Section</label>
        <select name="section_id" class="form-select" required>
          @foreach($sections as $section)
          <option value="{{ $section->id }}" {{ $joRequest->section_id == $section->id ? 'selected' : '' }}>
            {{ $section->name }}
          </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label class="form-label">Position Name</label>
        <input type="text" name="position_name" class="form-control" value="{{ $joRequest->position_name }}" required>
      </div>

      <div class="col-md-4">
        <label class="form-label">No. of Positions</label>
        <input type="number" name="no_of_position" class="form-control" value="{{ $joRequest->no_of_position }}" required>
      </div>

      <div class="col-md-4">
        <label class="form-label">Effectivity Date</label>
        <input type="date" name="effectivity_of_position" class="form-control" value="{{ \Carbon\Carbon::parse($joRequest->effectivity_of_position)->format('Y-m-d') }}" required>
      </div>

      <div class="col-md-4">
        <label class="form-label">Fund Source</label>
        <select name="fund_source_id" class="form-select">
          <option value="">-- Select --</option>
          @foreach($fundSources as $fund)
          <option value="{{ $fund->id }}" {{ $joRequest->fund_source_id == $fund->id ? 'selected' : '' }}>
            {{ $fund->fund_source }}
          </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control">{{ $joRequest->remarks }}</textarea>
      </div>

      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('planning.jo-requests.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </div>
  </form>
</div>
@endsection
