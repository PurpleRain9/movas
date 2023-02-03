<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('visa_application_head_id');
            $table->text('RejectComment');
            $table->date('RejectDate');
            $table->unsignedBigInteger('reviewer_id');
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
        Schema::dropIfExists('reject_histories');
    }
}
