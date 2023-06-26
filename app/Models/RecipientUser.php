<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientUser extends Model
{

    use HasFactory;

    protected $table = 'recipient_user';

    protected $fillable = [
        'recipient_id', 
        'user_id'
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
