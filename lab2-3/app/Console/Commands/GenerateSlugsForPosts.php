<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class GenerateSlugsForPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for all posts without slugs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('slug', null)->orWhere('slug', '')->get();
        $count = 0;

        foreach ($posts as $post) {
            $post->save(); // Sluggable trait will automatically generate the slug
            $count++;
        }

        $this->info("Generated slugs for {$count} posts.");
        return Command::SUCCESS;
    }
}
