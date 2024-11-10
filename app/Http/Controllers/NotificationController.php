<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DataTable\DataTable;
use App\Services\DataTable\RawOrdering;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class NotificationController extends Controller
{
    /**
     * Show received notification via the system.
     *
     * @return Response
     */
    public function index(): Response
    {
        $user = auth()->user();

        $unreadNotificationIds = $user->unreadNotifications()->pluck('id')->all();

        $dataTable = (new DataTable(
            $user->notifications()->orderByRaw('read_at IS NULL DESC')->getQuery()
        ))
            ->setColumn('data', 'Message', true)
            ->setColumn('created_at', 'Created', true)
            ->setColumn('read_at', 'Read', true)
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('read_at', 'dd.mm.YYYY H:i');

        $dataTable->setRawOrdering(new RawOrdering('read_at IS NULL'));

        return Inertia::render('Notifications/Index', [
            'dataTable'             => fn () => $dataTable->run(),
            'unreadNotificationIds' => fn () => $unreadNotificationIds,
        ]);
    }

    /**
     * Mark notification as read.
     *
     * @param                   $notificationId
     * @return RedirectResponse
     */
    public function read($notificationId): RedirectResponse
    {
        try {
            $user = auth()->user();
            $user->unreadNotifications
                ->where('id', $notificationId)
                ->markAsRead();

            Cache::forget("user_{$user->id}");

            return redirect()->back()->with('success', 'Notification marked as read.');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors(['Error marking notification.']);
        }
    }
}
