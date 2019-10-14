<?php

use App\Answer;
use App\Comment;
use App\Favorite;
use App\Question;
use App\Tag;
use App\User;
use App\VoteType;
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
        $this->tags();
        $this->questions();
        $this->answers();
        $this->comments();
        $this->voteTypes();
        Schema::enableForeignKeyConstraints();
    }

    public function tags()
    {
        Tag::truncate();

        // Create sample tags
        factory(Tag::class, 100)->create();
    }

    public function questions()
    {
        Question::truncate();
        Favorite::truncate();

        // create sample questions and users
        // to each question associate a random number of tags

        // get IDs from tags table
        $tagIds = Tag::pluck('id');

        factory(Question::class, 300)->create()->each(function ($question) use ($tagIds) {
            // get a random number
            $num = rand(1, 5);

            // get random number of tag IDs
            $randomTagIds = $tagIds->random($num);

            // attach those tags to the question
            $question->tags()->attach($randomTagIds);
        });
    }

    public function answers()
    {
        Answer::truncate();

        // create sample answers from existing users and questions
        factory(Answer::class, 600)->states('from_existing_questions_and_users')->create();
    }

    public function comments()
    {
        Comment::truncate();

        // create sample comments from existing questions and users
        factory(Comment::class, 500)->states('from_existing_questions_and_users')->create();

        // create sample comments from existing answers and users
        factory(Comment::class, 1000)->states('from_existing_answers_and_users')->create();
    }

    public function voteTypes()
    {
        VoteType::truncate();

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
