<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
  use HasFactory;

  protected $fillable = ['sg_num', 'step_increment', 'sg_amount'];
}
