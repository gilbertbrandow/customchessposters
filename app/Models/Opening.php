<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opening extends Model
{
    use HasFactory;

    protected $table = 'openings';

    protected $fillable = [
        'eco',
        'name',
    ];
}
