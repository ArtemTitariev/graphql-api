<?php

namespace App\GraphQL\Services\Statistics;

use App\Models\Tag;
use App\Models\User;

class UsersService
{
    /**
     * @return Illuminate\Database\Eloquent\Collection<User>
     */
    public function getSimilarUsers(User $user, int $limit)
    {
        $tags = Tag::withCount(['posts as tag_count' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
            ->orderByDesc('tag_count')
            ->limit(5)
            ->pluck('id');


        return User::where('id', '<>', $user->id)
            ->whereHas('posts.tags', function ($query) use ($tags) {
                $query->whereIn('tags.id', $tags);
            })
            ->withCount(['posts as common_tags_count' => function ($query) use ($tags) {
                $query->whereIn('posts.id', function ($q) use ($tags) {
                    $q->select('post_tag.post_id')
                        ->from('post_tag')
                        ->join('tags', 'tags.id', '=', 'post_tag.tag_id')
                        ->whereIn('tags.id', $tags);
                });
            }])
            ->orderByDesc('common_tags_count')
            ->limit($limit)
            ->get();
    }
}
