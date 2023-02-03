<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignTechician extends Model
{
    use HasFactory;

    protected $table = 'foreign_techicians';

    protected $fillable = [
        'Image',
        'Name',
        'Rank',
        'Qualification',
        'address',
        'phone_no',
        'Gender',
        'DateOfBirth',
        'PassportNo',
        'Status',
        'profile_id',
        'address',
        'phone_no',
        'form_c_filename',
        'home_address',
        'mic_aprroved_letter',
        'labour_card'
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
