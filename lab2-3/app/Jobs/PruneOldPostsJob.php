<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PruneOldPostsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Get the compared data
        $oldDate = Carbon::now()->subYears(2);

        $oldPosts = Post::where('created_at', '<', $oldDate)->get();

        //Get the count to back it to user
        $count = $oldPosts->count();

        if ($count === 0) {
            Log::info("PruneOldPostsJob: No posts found older than 2 years");
            return;
        }

        foreach ($oldPosts as $post) {
            Log::info("PruneOldPostsJob: Deleting post ID {$post->id}: {$post->title}");
            $post->delete();
        }

        Log::info("PruneOldPostsJob: Successfully deleted {$count} old posts");
    }
}
