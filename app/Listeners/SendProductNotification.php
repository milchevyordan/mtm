<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\MinimumQuantityReached;
use App\Models\User;
use App\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class SendProductNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param MinimumQuantityReached $event
     */
    public function handle(MinimumQuantityReached $event): void
    {
        $user = User::find(1);
        $event->product->load('quantity');

        foreach ($event->product->quantity as $quantity) {
            if ($quantity->quantity >= $event->product->minimum_quantity) {
                continue;
            }

            $message = "Product {$event->product->name} is running out of stock in {$quantity->warehouse->name}.";
            Notification::send($user, new DatabaseNotification($message));
        }

        Cache::forget("user_{$user->id}");
    }
}
