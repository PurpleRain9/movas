<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_application_head_id',
        'RejectComment',
        'RejectDate',
        'reviewer_id'
    ];

    public function reviewer()
    {
        return $this->belongsTo(Admin::class);
    }

    

}
