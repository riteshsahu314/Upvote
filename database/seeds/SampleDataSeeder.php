<?php

use App\Answer;
use App\Comment;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $this->comments();
        $this->voteTypes();
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

    public function comments()
    {
        Comment::truncate();

        // create sample questions and users
        factory(Comment::class, 60)->states('from_existing_questions_and_users')->create();
        factory(Comment::class, 100)->states('from_existing_answers_and_users')->create();
    }

    public function voteTypes()
    {
        DB::table('vote_types')->insert([
            [
                'name' => 'UpVote'
            ],

            [
                'name' => 'DownVote'
            ]
        ]);
    }
}
