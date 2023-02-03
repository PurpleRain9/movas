<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class DeletedUser extends Model
{
    use HasFactory;

    protected $table = 'deleted_users';
    
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone_no',
        'Status',
        'RejectComment',
        'admin_id'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }


}
