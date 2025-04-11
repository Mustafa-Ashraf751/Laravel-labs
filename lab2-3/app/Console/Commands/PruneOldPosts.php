<?php

namespace App\Console\Commands;

use App\Jobs\PruneOldPostsJob;
use Illuminate\Console\Command;

class PruneOldPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:prune{--years=2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete posts that older than specified number of years';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $years = $this->option('years');
        $this->info("Dispatching job to delete posts older than {$years} years...");

        PruneOldPostsJob::dispatch();

        $this->info('Job dispatched successfully');
        return Command::SUCCESS;
    }
}
