<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfoHistory extends Model
{
    use HasFactory;

    protected $table = 'contact_info_histories';

    protected $fillable = [
        'user_id',
        'old_name',
        'old_phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
