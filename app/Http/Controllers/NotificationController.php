<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DataTable\DataTable;
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

        $dataTable = (new DataTable(
            $user->notifications()->orderByRaw('read_at IS NULL DESC')->getQuery()
        ))
            ->setColumn('data', 'Съобщение', true)
            ->setColumn('created_at', 'Създадено', true)
            ->setColumn('read_at', 'Прочетено', true)
            ->setDateColumn('created_at', 'dd.mm.YYYY H:i')
            ->setDateColumn('read_at', 'dd.mm.YYYY H:i');

        return Inertia::render('Notifications/Index', [
            'dataTable' => fn () => $dataTable->run(),
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

    /**
     * Mark notification as read.
     *
     * @return RedirectResponse
     */
    public function readAll(): RedirectResponse
    {
        try {
            $user = auth()->user();

            $user->unreadNotifications
                ->markAsRead();

            Cache::forget("user_{$user->id}");

            return redirect()->back()->with('success', __('All notification marked read.'));
        } catch (Throwable $th) {
            Log::error($th->getMessage(), ['exception' => $th]);

            return redirect()->back()->withErrors([__('Error marking notifications.')]);
        }
    }
}
