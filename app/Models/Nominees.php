<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $fillable = ['award_id', 'name', 'bio'];

    public function award()
    {
        return $this->belongsTo(Award::class);
    }
}
