<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LeaveCredits extends Model
{
    use HasFactory;

    protected $fillable = [
      'employee_id',
      'employee_name_id',
      'vacation_leave',
      'sick_leave',
      'total_leave',
    ];

public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_name_id');
    }
}
