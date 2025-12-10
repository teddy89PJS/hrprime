<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'cities'; // or 'cities'
    protected $fillable = ['psgc', 'name'];
    public $timestamps = false;
}
