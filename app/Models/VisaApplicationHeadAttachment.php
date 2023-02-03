<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplicationHeadAttachment extends Model
{
    use HasFactory;

    protected $table = 'visa_application_head_attachments';
    
    // protected $primaryKey = 'VisaApplicationHeadAttachmentID';
    
    protected $fillable = [
    		'visa_application_head_id',
    		'FilePath',
            'Description',
    ];
}
