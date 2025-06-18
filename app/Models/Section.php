<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  use HasFactory;

  protected $fillable = [
    'division_id',
    'name',
    'abbreviation'
  ];

  public function division()
  {
    return $this->belongsTo(Division::class);
  }
}
