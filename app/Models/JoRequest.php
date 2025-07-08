<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoRequest extends Model
{
  use HasFactory;

  protected $fillable = [
    'type',                    // creation, extension, abolition
    'subject',                 // subject/description/title of request
    'section_id',              // foreign key to the sections table
    'position_name',
    'no_of_position',
    'effectivity_of_position',
    'remarks',
    'fund_source_id',          // if related to fund_sources table
    'status', // ✅ make sure this is included
  ];

  protected $dates = [
    'effectivity_of_position',
  ];

  // Relationship to FundSource
  public function fundSource()
  {
    return $this->belongsTo(FundSource::class);
  }

  // Relationship to Section
  public function section()
  {
    return $this->belongsTo(Section::class);
  }
}
