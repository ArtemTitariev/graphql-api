<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserStatisticsResolver
{
    /**
     * @param $rootValue
     * @param  array  $args
     * @param  GraphQLContext|null  $context
     * @param  ResolveInfo  $resolveInfo
     * @return array
     */
    public function __invoke(User $user, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $requestedFields = $resolveInfo->getFieldSelection();

        $totalPosts = $user->posts()->count();

        $totalWords = 0;
        if (isset($requestedFields['average_post_length'])) {
            $user->posts()->select('content')->chunk(100, function ($posts) use (&$totalWords) {
                foreach ($posts as $post) {
                    $totalWords += str_word_count($post->content);
                }
            });
        }

        $averageLength = $totalPosts > 0 ? $totalWords / $totalPosts : 0;

        $totalComments = 0;
        if (isset($requestedFields['total_comments'])) {
            $totalComments = $user->comments()->count();
        }

        return [
            'total_posts' => $totalPosts,
            'average_post_length' => $averageLength,
            'total_comments' => $totalComments,
        ];
    }
}
