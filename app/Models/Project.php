<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Warehouse;
use App\Traits\HasChangeLogs;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasCreator;
    use HasChangeLogs;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'warehouse',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'warehouse' => Warehouse::class,
    ];
}
