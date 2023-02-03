<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaApplicationHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_application_heads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('profile_id');
            $table->text('StaffLocalProposal');
            $table->text('StaffForeignProposal');
            $table->text('StaffLocalSurplus');
            $table->text('StaffForeignSurplus');
            $table->text('StaffLocalAppointed');
            $table->text('StaffForeignAppointed');
            $table->text('FirstApplyDate')->nullable();
            $table->text('FinalApplyDate')->nullable();
            $table->text('ApproveDate')->nullable();
            $table->text('ApproveLetterNo')->nullable();
            $table->integer('ReviewerSubmitted');
            $table->integer('Status');
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
        Schema::dropIfExists('visa_application_heads');
    }
}
