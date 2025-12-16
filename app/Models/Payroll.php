<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class Payroll extends Model
{

  use HasFactory;

  protected $table = 'payroll';

  protected $fillable = [
    'request_date',
    'period_from',
    'period_to',
    'fund_source_id',
    'employee_name_id',
    'position_id',
    'sg_num_id',
    'employee_id',
    'base_rate_id',
    'premium_amount_id',
    'total_amount_id',
    'late_and_absences',
    'gross_amount_earned',
    'tax_witheld',
    'deduction_name_id',
    'deduction_amount_id',
    'total_deductions',
    'net_amount_due_total',
    'remarks',
    'status',
  ];
  public function fundsource()
  {
    return $this->belongsTo(FundSource::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function position()
  {
    return $this->belongsTo(Position::class);
  }
  public function salary_grade()
  {
    return $this->belongsTo(SalaryGrade::class);
  }
  public function deduction()
  {
    return $this->belongsTo(Deduction::class);
  }
}
