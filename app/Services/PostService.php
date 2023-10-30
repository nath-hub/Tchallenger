<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function store($input, $user)
    {
        $input["user_id"] = $user->id;

        $state = Post::create($input);

        return $state;
    }

    public function view($post)
    {
        return [$post->categorie, $post->getAttributes()];
    }

    public function update(Post $postToUpdate, $input)
    {

        $state = $postToUpdate->update($input);

        return $state;
    }


    public function delete(Post $post)
    {
        $state = $post->delete();

        $post->participations()->delete();

        return $state;
    }
}
