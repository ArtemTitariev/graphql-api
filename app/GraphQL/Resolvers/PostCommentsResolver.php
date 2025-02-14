<?php

namespace App\GraphQL\Resolvers;

use App\Models\Comment;
use App\Models\Post;

class PostCommentsResolver
{
    public function __invoke(Post $post)
    {
        return Comment::where('post_id', $post->id)
            ->whereNull('reply_to')
            ->get();
    }
}
