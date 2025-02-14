<?php

namespace App\GraphQL\Resolvers;

use App\Models\Comment;
use App\Models\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateCommentResolver
{
    /**
     * @param $rootValue
     * @param  array  $args
     * @param  GraphQLContext|null  $context
     * @param  ResolveInfo  $resolveInfo
     * @return Comment
     */
    public function __invoke($root, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $user = $context->user();

        $post = Post::findOrFail($args['post_id']);

        return Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'content' => $args['content'],
            'reply_to' => $args['reply_to'] ?? null
        ]);
    }
}
