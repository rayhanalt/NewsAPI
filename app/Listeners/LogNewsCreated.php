<?php

namespace App\Listeners;

use App\Models\Log;
use App\Events\NewsCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNewsCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewsCreated  $event
     * @return void
     */
    public function handle(NewsCreated $event)
    {
        $news = $event->news;
        // Simpan log ke dalam database
        Log::create([
            'user_id' => Auth::user()->id,
            'news_id' => $news->id,
            'action' => 'Berita baru telah dibuat',
        ]);
    }
}
