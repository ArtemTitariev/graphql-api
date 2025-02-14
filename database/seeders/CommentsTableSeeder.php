<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::truncate();
        Comment::unguard();

        $faker = \Faker\Factory::create();

        $users = User::all();

        Post::chunk(100, function ($posts) use ($faker, $users) {
            foreach ($posts as $post) {
                foreach (range(1, 4) as $i) {
                    Comment::create([
                        'post_id' => $post->id,
                        'user_id' => $users->random()->id,
                        'reply_to' => null,
                        'content' => $faker->sentences(2, true),
                    ]);
                }
            }
        });

        $commentIds = Comment::pluck('id');

        foreach ($commentIds as $commentId) {
            foreach (range(1, 2) as $i) {
                $comment = Comment::find($commentId);
                if ($comment) {
                    Comment::create([
                        'reply_to' => $comment->id,
                        'post_id' => $comment->post_id,
                        'user_id' => $users->random()->id,
                        'content' => $faker->sentences(3, true),
                    ]);
                }
            }
        }
    }
}
