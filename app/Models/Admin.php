<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Sector;
use App\Models\ProfileDelete;
class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $table = 'admins';
    
    // protected $primaryKey = 'AdminID';
    
    protected $fillable = [
    		'UserID',
            'username',
    		'password',
    		'Status',
    		'rank_id',
    ];

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class, 'admin_sector', 'admin_id', 'sector_id');
    }

    public function deleteprofile(){
        return $this->hasMany(ProfileDelete::class);
    }

    
}
