<?php

namespace App\GraphQL\Resolvers\Statistics;

use App\GraphQL\Services\Statistics\PostsService;
use App\Models\Post;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MostDiscussedPostsResolver
{
    public function __construct(
        protected PostsService $service,
    ) {}

    /**
     * @param $rootValue
     * @param  array  $args
     * @param  GraphQLContext|null  $context
     * @param  ResolveInfo  $resolveInfo
     * @return Illuminate\Database\Eloquent\Collection<Post>
     */
    public function __invoke($root, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->service->getMostDiscussedPosts(
            $args['limit'],
            $args['tagIds'] ?? null,
            $args['userId'] ?? null,
        );
    }
}
