<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VisaApplicationDetail;

class VisaApplicationDetailAttachment extends Model
{
    use HasFactory;

    protected $table = 'visa_application_detail_attachments';
    
    // protected $primaryKey = 'VisaApplicationDetailAttachmentID';
    
    protected $fillable = [
    		'visa_application_detail_id',
    		'FilePath',
            'Description',
    ];

    public function visa_detail()
    {
        return $this->belongsTo(VisaApplicationDetail::class);
    }
}
