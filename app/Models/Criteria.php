<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['award_id', 'title'];

    public function award()
    {
        return $this->belongsTo(Award::class);
    }
}
