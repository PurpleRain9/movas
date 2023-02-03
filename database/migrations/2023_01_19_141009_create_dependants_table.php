<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependants', function (Blueprint $table) {
            $table->id();
            $table->string('image');    
            $table->text('name');
            $table->text('rank');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('formc_address');
            $table->text('passport_no');
            $table->string('phone_no');
            $table->string('qualification');
            $table->string('permanent_address');
            $table->string('relation');
            $table->integer('status')->nullable();
            $table->integer('profile_id')->nullable();

            $table->date('first_apply_date')->nullable();
            $table->date('final_apply_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->date('rejected_date')->nullable();
            $table->text('reject_comment')->nullable();
            $table->text('mic_copy_resigned_letter_filename')->nullable();

            $table->text('formc_file_name')->nullable();
            $table->text('passport_filename')->nullable();
            $table->text('mic_permit_filename')->nullable();
            $table->text('air_ticket_filename')->nullable();
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
        Schema::dropIfExists('dependants');
    }
}
