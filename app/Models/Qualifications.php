<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    // Relationship to users (qualified staff)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relationship to vacant positions
    public function vacantPositions()
    {
        return $this->hasMany(VacantPosition::class);
    }
}
