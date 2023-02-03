<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('rejectTimes')->default(0);
            $table->text('CompanyName');
            $table->text('CompanyRegistrationNo');
            $table->integer('sector_id');
            $table->text('BusinessType');
            $table->integer('permit_type_id');
            $table->text('PermitNo');
            $table->text('PermittedDate');
            $table->text('CommercializationDate');
            $table->text('LandNo');
            $table->text('LandSurveyDistrictNo');
            $table->text('IndustrialZone');
            $table->text('Township');
            $table->integer('region_id');
            $table->text('StaffLocalProposal');
            $table->text('StaffForeignProposal');
            $table->text('StaffLocalSurplus');
            $table->text('StaffForeignSurplus');
            $table->text('StaffLocalAppointed');
            $table->text('StaffForeignAppointed');
            $table->text('AttachCompanyRegistrationCard');
            $table->text('AttachPermit');
            $table->integer('Status');
            $table->date('ApproveDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
