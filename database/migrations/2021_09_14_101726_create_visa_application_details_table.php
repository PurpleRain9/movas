<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_application_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visa_application_head_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->integer('reject_status');
            $table->integer('nationality_id');
            $table->text('PersonName');
            $table->text('PassportNo');
            $table->date('StayAllowDate');
            $table->date('StayExpireDate');
            $table->integer('person_type_id');
            $table->date('DateOfBirth');
            $table->text('Gender');
            $table->integer('visa_type_id')->nullable();
            $table->text('passport_attach')->nullable();
            $table->text('mic_approved_letter_attach')->nullable();
            $table->text('labour_card_attach')->nullable();
            $table->text('extract_form_attach')->nullable();
            $table->text('technician_passport_attach')->nullable();
            $table->text('evidence_attach')->nullable();
            $table->integer('stay_type_id');
            $table->integer('labour_card_type_id');
            $table->integer('labour_card_duration_id');
            $table->integer('relation_ship_id')->nullable();
            $table->text('Remark')->nullable();
            $table->integer('labour_approve')->nullable();
            $table->integer('immegration_approve')->nullable();
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
        Schema::dropIfExists('visa_application_details');
    }
}
