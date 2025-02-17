<?php

namespace App\GraphQL\Resolvers\Statistics;

use App\GraphQL\Services\Statistics\UsersService;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SimilarUsersResolver
{
    public function __construct(
        protected UsersService $service,
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
        $user = $context->user();

        return $this->service->getSimilarUsers($user, $args['limit']);
    }
}
