<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacantPosition extends Model
{
    // Relationship to the required qualification
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    // Relationship to users (staff) who match this position's qualification
    public function qualifiedStaff()
    {
        return $this->hasMany(User::class, 'qualification_id', 'qualification_id');
    }
}
