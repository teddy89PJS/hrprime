<div class="mb-3">
  <label>Position Name</label>
  <input type="text" name="position_name" class="form-control" required>
</div>

<div class="mb-3">
  <label>Abbreviation</label>
  <input type="text" name="abbreviation" class="form-control" required>
</div>

<div class="mb-3">
  <label>Item No</label>
  <input type="text" name="item_no" class="form-control" required>
</div>

<div class="mb-3">
  <label>Salary Grade</label>
  <select name="salary_grade_id" class="form-control" required>
    <option disabled selected>Choose Salary Grade</option>
    @foreach($salaryGrades as $grade)
    <option value="{{ $grade->id }}">{{ $grade->sg_num }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label>Employment Status</label>
  <select name="employment_status_id" class="form-control" required>
    <option disabled selected>Choose Employment Status</option>
    @foreach($employmentStatuses as $status)
    <option value="{{ $status->id }}">{{ $status->name }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label>Status</label>
  <select name="status" class="form-control" required>
    <option value="active" selected>Active</option>
    <option value="inactive">Inactive</option>
  </select>
</div>
