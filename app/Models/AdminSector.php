<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSector extends Model
{
    use HasFactory;

    protected $table = 'admin_sectors';
    
    protected $fillable = [
    		'admin_id',
    		'sector_id',
    ];
}
