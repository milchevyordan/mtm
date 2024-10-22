<?php

declare(strict_types=1);

/*
 *     This file is part of Auto Trader.
 *
 *     (c) James IT Services | Louis Hage <louis@jamesitservices.com>
 *
 *     Copyright 2000-2024, James IT Services Ltd
 *     All rights reserved.
 */

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DatabaseNotification extends Notification
{
    use Queueable;

    private string $message;

    /**
     * Create a new notification instance.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  object             $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  object               $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
