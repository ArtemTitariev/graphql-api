<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::all();

        Post::chunk(100, function ($posts) use ($tags) {
            foreach ($posts as $post) {
                $randomTags = $tags->random(rand(1, 4));

                foreach ($randomTags as $tag) {
                    $post->tags()->attach($tag->id);
                }
            }
        });
    }
}
