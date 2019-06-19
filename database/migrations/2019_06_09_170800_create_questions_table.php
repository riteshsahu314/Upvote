<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('answers_count')->default(0);
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('best_answer_id')->nullable();
            $table->timestamps();

            $table->foreign('best_answer_id')
                ->references('id')
                ->on('answers')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
