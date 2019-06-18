<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            // as we will be searching for activities by the subject
            // so for faster search make this column indexed
            $table->unsignedBigInteger('user_id')->index();
            // as we will be searching for activities by the subject
            // so for faster search make this column indexed
            $table->unsignedBigInteger('subject_id')->index();
            $table->string('subject_type', 50);
            $table->string('type');
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
        Schema::dropIfExists('activities');
    }
}
