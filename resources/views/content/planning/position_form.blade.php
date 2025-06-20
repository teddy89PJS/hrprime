<div class="mb-3">
  <label>Position Name</label>
  <input type="text" name="position_name" class="form-control text-uppercase" required>
</div>

<div class="mb-3">
  <label>Abbreviation</label>
  <input type="text" name="abbreviation" class="form-control text-uppercase" required>
</div>

<div class="mb-3">
  <label>Item No</label>
  <input type="text" name="item_no" class="form-control text-uppercase" required>
</div>

<div class="mb-3">
  <label>Salary Grade</label>
  <select name="salary_grade_id" class="form-control text-uppercase" required>
    <option disabled selected>CHOOSE SALARY GRADE</option>
    @foreach($salaryGrades as $grade)
    <option value="{{ $grade->id }}">{{ Str::upper($grade->sg_num) }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label>Employment Status</label>
  <select name="employment_status_id" class="form-control text-uppercase" required>
    <option disabled selected>CHOOSE EMPLOYMENT STATUS</option>
    @foreach($employmentStatuses as $status)
    <option value="{{ $status->id }}">{{ Str::upper($status->name) }}</option>
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label>Status</label>
  <select name="status" class="form-control text-uppercase" required>
    <option value="active" selected>ACTIVE</option>
    <option value="inactive">INACTIVE</option>
  </select>
</div>
