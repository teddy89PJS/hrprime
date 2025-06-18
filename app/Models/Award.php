<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function criteria()
    {
        return $this->hasMany(Criteria::class);
    }

    public function nominees()
    {
        return $this->hasMany(Nominee::class);
    }
}