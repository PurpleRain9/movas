<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependant extends Model
{
    use HasFactory;

    protected $table = 'dependants';

    protected $fillable = [
        'image',
        'name',
        'rank',
        'qualification',
        'formc_address',
        'permanent_address',
        'passport_no',
        'phone_no',
        'relation',
        'gender',
        'date_of_birth',
        'status',
        'profile_id',
        'formc_file_name',
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
