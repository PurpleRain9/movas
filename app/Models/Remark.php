<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $table = 'remarks';
    
    // protected $primaryKey = 'RelationShipID';
    
    protected $fillable = [
    		'visa_application_head_id',
            'Remark',
    		'ReviewDate',
    		'FromAdminID',
    		'FromRankID',
    		'ToAdminID',
    		'ToRankID',
    		'SubmittedStatus',
    ];

	public function reviewer()
    {
        return $this->belongsTo(Admin::class,'FromAdminID','id');
    }

}
