<?php

namespace App\Services;

use App\Models\Participation;
use App\Models\Post;
use App\Models\Vote;

class VoteService
{
    public function vote($input, $user)
    {
        $vote = Vote::where("user_id", $user->id)->first();

        if (!isset($vote)) {

            $input["user_id"] = $user->id;

            $state = Vote::create($input);

            $par = Participation::find($state->participation_id);

            $par->nb_vote = $par->nb_vote + 1;

            $par->save();

            $post = Post::find($par->post_id);

            $post->n_vote = $par->n_vote + 1;

            $post->save();

        } else {
            
            $state = $vote->delete();

            $par = Participation::find($vote->participation_id);

            $par->nb_vote = $par->nb_vote - 1;

            $par->save();

            $post = Post::find($par->post_id);

            $post->n_vote = $par->n_vote - 1;

            $post->save();
        }

        return $state;
    }


    public function view($vote)
    {
        return [$vote];
    }


    public function update($vote, $input)
    {

        $vote->delete();

        $par = Participation::find($vote->participation_id);

        $par->nb_vote = $par->nb_vote - 1;

        $par->save();

        $post = Post::find($par->post_id);

        $post->n_vote = $par->n_vote - 1;

        $post->save();

        return $vote;
    }
}
