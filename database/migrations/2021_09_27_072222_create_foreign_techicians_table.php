<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignTechiciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_techicians', function (Blueprint $table) {
            $table->id();
            $table->string('Image');    
            $table->text('Name');
            $table->text('Rank');
            $table->string('Gender');
            $table->date('DateOfBirth');
            $table->text('PassportNo');
            $table->integer('Status')->nullable();
            $table->integer('profile_id')->nullable();

            $table->date('first_apply_date')->nullable();
            $table->date('final_apply_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->date('rejected_date')->nullable();
            $table->text('reject_comment')->nullable();
            $table->text('mic_copy_resigned_letter_filename')->nullable();
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
        Schema::dropIfExists('foreign_techicians');
    }
}
