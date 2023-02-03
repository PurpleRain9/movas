<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remarks', function (Blueprint $table) {
            $table->id();
            $table->integer('visa_application_head_id');
            $table->text('Remark');
            $table->date('ReviewDate');
            $table->integer('FromAdminID');
            $table->integer('FromRankID');
            $table->integer('ToAdminID');
            $table->integer('ToRankID');
            $table->integer('SubmittedStatus');
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
        Schema::dropIfExists('remarks');
    }
}
