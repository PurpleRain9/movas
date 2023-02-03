<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StayType extends Model
{
    use HasFactory;

    protected $table = 'stay_types';
    
    // protected $primaryKey = 'StayTypeID';
    
    protected $fillable = [
    		'StayTypeName',
    		'StayTypeNameMM',
    ];
}
