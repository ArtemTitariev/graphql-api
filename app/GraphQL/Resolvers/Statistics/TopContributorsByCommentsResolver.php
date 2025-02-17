<?php

namespace App\GraphQL\Resolvers\Statistics;

use App\GraphQL\Services\Statistics\TopContributorsService;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TopContributorsByCommentsResolver
{
    public function __construct(
        protected TopContributorsService $service,
    ) {}

    /**
     * @param $rootValue
     * @param  array  $args
     * @param  GraphQLContext|null  $context
     * @param  ResolveInfo  $resolveInfo
     * @return Illuminate\Database\Eloquent\Collection<User>
     */
    public function __invoke($root, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->service->getTopContributorsByComments($args['limit']);
    }
}
