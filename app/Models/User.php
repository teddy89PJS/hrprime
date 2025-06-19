<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = [
    'employee_id',
    'first_name',
    'middle_name',
    'last_name',
    'extension_name',
    'employment_status_id',
    'division_id',
    'section_id',
    'username',
    'email',
    'password',
  ];

  protected $hidden = [
    'password',
  ];
  public function division()
  {
    return $this->belongsTo(Division::class, 'division_id');
  }

  public function section()
  {
    return $this->belongsTo(Section::class, 'section_id');
  }

  public function employmentStatus()
  {
    return $this->belongsTo(EmploymentStatus::class, 'employment_status_id');
  }
}
