<?php

namespace App\Providers;

use App\Models\Song;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetFavouriteSong
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Song $song;
    public User $user;
    public $isFav;
    /**
     * Create a new event instance.
     */
    public function __construct($song, $user, $isFav)
    {
        $this->song = $song;
        $this->user = $user;
        $this->isFav = $isFav;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
