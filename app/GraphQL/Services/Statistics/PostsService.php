<?php

namespace App\GraphQL\Services\Statistics;

use App\Models\Post;

class PostsService
{
    /**
     * @return Illuminate\Database\Eloquent\Collection<Post>
     */
    public function getMostDiscussedPosts(int $limit, ?array $tagIds, ?int $userId)
    {
        return Post::withCount('comments')
            ->when(!(empty($tagIds)), function ($query) use ($tagIds) {
                return $query->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                });
            })
            ->when(!empty($userId), function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->orderBy('comments_count')
            ->limit($limit)
            ->get();
    }
}
