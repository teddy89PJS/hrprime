<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  use HasFactory;

  protected $fillable = [
    'position_name',
    'abbreviation',
    'item_no',
    'salary_grade_id',
    'employment_status_id',
    'status',
  ];

  public function salaryGrade()
  {
    return $this->belongsTo(SalaryGrade::class);
  }

  public function employmentStatus()
  {
    return $this->belongsTo(EmploymentStatus::class);
  }
}
