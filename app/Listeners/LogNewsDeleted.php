<?php

namespace App\Listeners;

use App\Models\Log;
use App\Events\NewsDeleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNewsDeleted
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
     * @param  \App\Events\NewsDeleted  $event
     * @return void
     */
    public function handle(NewsDeleted $event)
    {
        $news = $event->news;
        // Simpan log ke dalam database
        Log::create([
            'user_id' => Auth::user()->id,
            'news_id' => $news->id,
            'action' => 'Berita telah dihapus',
        ]);
    }
}
