<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $fillable = [
    'title',
    'code',
    'type',
    'duration',
    'date',
    'file_path'
  ];
}
