<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    // Relationships
    public function vacantPositions()
    {
        return $this->hasMany(VacantPosition::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'qualification_id');
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'position_qualification');
    }
}
