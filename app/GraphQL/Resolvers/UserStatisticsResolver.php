<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;

class UserStatisticsResolver
{
    public function __invoke(User $user)
    {
        // Отримуємо всі статті користувача
        $posts = $user->posts;

        // Обчислюємо кількість статей
        $totalPosts = $posts->count();

        // Обчислюємо середню довжину статей (якщо є статті)
        $averageLength = $totalPosts > 0
            ? $posts->avg(fn($post) => str_word_count($post->content))
            : 0;

        // Повертаємо дані у форматі GraphQL-типу
        return [
            'total_posts' => $totalPosts,
            'average_post_length' => round($averageLength, 2),
        ];
    }
}
