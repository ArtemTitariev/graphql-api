<?php

namespace App\GraphQL\Services\Statistics;

use App\Models\User;

class TopContributorsService
{
    /**
     * @return Illuminate\Database\Eloquent\Collection<User>
     */
    public function getTopContributorsByPosts(int $limit)
    {
        return User::withCount('posts')
            ->orderBy('posts_count')
            ->limit($limit)
            ->get();
    }

    /**
     * @return Illuminate\Database\Eloquent\Collection<User>
     */
    public function getTopContributorsByComments(int $limit)
    {
        return User::withCount('comments')
            ->orderBy('comments_count')
            ->limit($limit)
            ->get();
    }
}
