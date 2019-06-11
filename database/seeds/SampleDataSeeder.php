<?php

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->questions();
        $this->answers();
        Schema::enableForeignKeyConstraints();
    }

    public function questions()
    {
        Question::truncate();

        // create sample questions and users
        factory(Question::class, 30)->create();
    }

    public function answers()
    {
        Answer::truncate();

        // create sample questions and users
        factory(Answer::class, 60)->states('from_existing_questions_and_users')->create();
    }
}
