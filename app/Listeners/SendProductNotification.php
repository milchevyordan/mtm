<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Warehouse;
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
        $users = User::where('warehouse', Warehouse::Varna->value)->get();
        $event->product->load('quantity');

        foreach ($event->product->quantity as $quantity) {
            if ($quantity->quantity >= $event->product->minimum_quantity) {
                continue;
            }

            $message = "Product {$event->product->name} is running out of stock in {$quantity->warehouse->name}.";
            Notification::send($users, new DatabaseNotification($message));
        }

        foreach ($users as $user) {
            Cache::forget("user_{$user->id}");
        }
    }
}
