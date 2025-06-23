<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesList extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','employee_name','position','employment_status','section','division','office_location','sg','username'];

}

