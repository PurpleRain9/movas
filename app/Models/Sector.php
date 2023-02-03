<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Admin;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';
    
    // protected $primaryKey = 'SectorID';
    
    protected $fillable = [
    		'SectorName',
    		'SectorNameMM',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_sector', 'sector_id', 'admin_id');
    }
}
