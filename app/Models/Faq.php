<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'featured', 
    ];

    protected $casts = [
        'updated_at'  => 'date:M d, Y',
    ];

    protected $table = 'faqs';
}
