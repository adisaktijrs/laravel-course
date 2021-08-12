<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = App\BlogPost::all();

        if ($posts->count() === 0) {
            $this->command->info('U suck! There is no post, therefore no comment will be added');
            return;
        }

        $commentsCount = (int) $this->command->ask('How many comments would u like?', 150);

        factory(App\Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
