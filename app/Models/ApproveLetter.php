<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveLetter extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_application_head_id',
        'letterNo'
];

}
