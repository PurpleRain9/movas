<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDelete extends Model
{
    use HasFactory;

    protected $table = 'profiles_delete';

    protected $fillable = [
        'user_id',
        'rejectTimes',
        'CompanyName',
        'CompanyRegistrationNo',
        'sector_id',
        'BusinessType',
        'permit_type_id',
        'PermitNo',
        'PermittedDate',
        'CommercializationDate',
        'LandNo',
        'LandSurveyDistrictNo',
        'IndustrialZone',
        'Township',
        'region_id',
        'StaffLocalProposal',
        'StaffForeignProposal',
        'StaffLocalSurplus',
        'StaffForeignSurplus',
        'StaffLocalAppointed',
        'StaffForeignAppointed',
        'AttachPermit',
        'AttachProposal',
        'AttachAppointed',
        'AttachIncreased',
        'Status','ApproveDate',
        'admin_id'
    ];


    public function admin(){
        return $this->belongsTo(Admin::class);
    }

}
