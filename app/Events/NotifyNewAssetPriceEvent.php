<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyNewAssetPriceEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $cryptoData;

    public function __construct(array $cryptoData)
    {
        $this->cryptoData = $cryptoData;
    }

    public function broadcastAs()
    {
        return 'asset-price-change';
    }

    public function broadcastOn()
    {
        return new Channel('crypto-currency-dashboard');
    }

    public function broadcastWith()
    {
        return $this->cryptoData;
    }
}
