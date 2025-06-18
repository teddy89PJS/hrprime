<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'abbreviation'
  ];

  // ✅ A division has many sections
  public function sections()
  {
    return $this->hasMany(Section::class);
  }

  // ✅ If you want units directly related via sections, this is optional
  public function units()
  {
    return $this->hasManyThrough(Unit::class, Section::class);
  }
}
