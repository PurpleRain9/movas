<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileRejectHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'description','reviewer_id','reviewer_rank_id'
    ];
}
