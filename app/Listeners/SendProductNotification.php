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
        $location = null;

        if ($event->product->quantity_netherlands < $event->product->minimum_quantity) {
            $location = 'Netherlands';
        } elseif ($event->product->quantity_france < $event->product->minimum_quantity) {
            $location = 'France';
        }

        if (! $location) {
            return;
        }

        $message = "Product {$event->product->name} is running out of stock in {$location}.";
        Notification::send($user, new DatabaseNotification($message));

        Cache::forget("user_{$user->id}");
    }
}
