<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class PermitType extends Model
{
    use HasFactory;

    protected $table = 'permit_types';
    
    // protected $primaryKey = 'PermitTypeID';
    
    protected $fillable = [
    		'PermitTypeName',
    		'PermitTypeNameMM',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
