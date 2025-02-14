<?php

namespace App\GraphQL\Resolvers;

use App\Models\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostTagsResolver
{
    /**
     * @param $rootValue
     * @param  array  $args
     * @param  GraphQLContext|null  $context
     * @param  ResolveInfo  $resolveInfo
     * @return Post
     */
    public function addTagsToPost($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $post = Post::findOrFail($args['id']);

        $post->tags()->syncWithoutDetaching($args['tag_ids']);

        return $post;
    }

    public function removeTagsFromPost($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $post = Post::findOrFail($args['id']);

        $post->tags()->detach($args['tag_ids']);

        return $post;
    }
}
