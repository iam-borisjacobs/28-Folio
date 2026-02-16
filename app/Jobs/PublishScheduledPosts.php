<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Post;
use App\Models\Activity;

class PublishScheduledPosts implements ShouldQueue
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
        $postsToPublish = Post::where('status', 'scheduled')
            ->where('published_at', '<=', now())
            ->get();

        foreach ($postsToPublish as $post) {
            $post->update(['status' => 'published']);

            Activity::create([
                'user_id' => null, // System action
                'action' => 'published scheduled post',
                'subject_type' => Post::class,
                'subject_id' => $post->id,
            ]);
        }
    }
}
