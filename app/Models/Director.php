<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $table = 'directors';

    protected $fillable = [
        'image',
        'name',
        'rank',
        'qualification',
        'permanent_address',
        'formc_address',
        'phone_no',
        'gender',
        'date_of_birth',
        'passport_no',
        'status',
        'profile_id',
        'reject_comment',
        'mic_copy_resigned_letter_filename',
        'formc_file_name',
        'passport',
        'extract_filename',
    ];

    protected $dates = [
        'first_apply_date',
        'final_apply_date',
        'approved_date',
        'rejected_date'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
