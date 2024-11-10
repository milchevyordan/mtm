<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\ChangeLog;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasChangeLogs
{
    /**
     * Retrieve change log of the resource.
     *
     * @return MorphMany
     */
    public function changeLogs(): MorphMany
    {
        return $this->morphMany(ChangeLog::class, 'changeable');
    }

    /**
     * Retrieve limited change log of the resource shown in edit forms.
     */
    public function changeLogsLimited()
    {
        return $this->changeLogs()->with(['creator'])->latest()->limit(20);
    }
}
