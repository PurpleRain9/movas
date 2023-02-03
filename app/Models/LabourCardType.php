<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourCardType extends Model
{
    use HasFactory;

    protected $table = 'labour_card_types';
    
    // protected $primaryKey = 'LabourCardTypeID';
    
    protected $fillable = [
    		'LabourCardTypeName',
    		'LabourCardTypeMM',
    ];
}
