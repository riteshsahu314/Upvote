<?php


namespace App;


trait Voteable
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function upvote()
    {
        $upVoteId = VoteType::whereName('UpVote')->pluck('id')->first();

        $attributes = [
            'user_id' => auth()->id(),
            'vote_types_id' => $upVoteId
        ];

        // prevent from up voting twice
        if (!$this->votes()->where($attributes)->exists()) {
            return $this->votes()->create($attributes);
        } else {
            return false;
        }
    }

    public function downvote()
    {
        $downVoteId = VoteType::whereName('DownVote')->pluck('id')->first();

        $attributes = [
            'user_id' => auth()->id(),
            'vote_types_id' => $downVoteId
        ];

        // prevent from up voting twice
        if (!$this->votes()->where($attributes)->exists()) {
            return $this->votes()->create($attributes);
        } else {
            return false;
        }
    }
}
