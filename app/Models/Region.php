<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';
    
    // protected $primaryKey = 'RegionID';
    
    protected $fillable = [
    		'RegionName',
    		'RegionNameMM',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
