<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourCardDuration extends Model
{
    use HasFactory;

    protected $table = 'labour_card_durations';
    
    // protected $primaryKey = 'StayTypeID';
    
    protected $fillable = [
            'LabourCardDuration',
            'LabourCardDurationMM',
    ];
}
