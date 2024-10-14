<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasChangeLogs;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
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
        'internal_id',
    ];

    /**
     * Array holding fields that should be selected in the default datatable structure.
     *
     * @var array|string[]
     */
    public static array $defaultSelectFields = ['id', 'name', 'internal_id', 'created_at'];

    /**
     * Availability relation.
     *
     * @return HasMany
     */
    public function availability(): HasMany
    {
        return $this->hasMany(AvailabilityProduct::class);
    }
}
