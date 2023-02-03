<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\User;
use App\Models\Admin;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationHeadAttachment;

class VisaApplicationHead extends Model
{
    use HasFactory;

    protected $table = 'visa_application_heads';
    
    // protected $primaryKey = 'VisaApplicationHeadID';
    
    protected $fillable = [
    		'user_id',
    		'profile_id',
            'CompanyName',
            'Township',
            'PermitNo',
            'PermittedDate',
            'BusinessType',
    		'StaffLocalProposal',
            'StaffForeignProposal',
            'StaffLocalSurplus',
            'StaffForeignSurplus',
            'StaffLocalAppointed',
            'StaffForeignAppointed',
            'Subject',
            'FirstApplyDate',
            'FinalApplyDate',
            'RejectedDate',
            'ApproveDate',
            'ApproveLetterNo',
            'ReviewerSubmitted',
            'Status',
            'OssStatus',
            'IntegrationActionStatus',
            'IntegrationActionDate',
            'IntegrationActionRemark',
            'LabourActionStatus',
            'LabourActionDate',
            'LabourActionRemark',
            'TurnDown',
            'RejectComment',
            'reviewer_id',
            'approve_admin_id',
            'approve_rank_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function visa_details()
    {
        return $this->hasMany(VisaApplicationDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visa_head_attachments()
    {
        return $this->hasMany(VisaApplicationHeadAttachment::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'approve_admin_id');
    }

}
