<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ChangeLog extends Model
{
    use HasCreator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'creator_id',
        'changeable_type',
        'changeable_id',
        'action',
        'change',
    ];

    /**
     * Get the parent changeable model (e.g., Order, Product, etc.).
     */
    public function changeable(): MorphTo
    {
        return $this->morphTo();
    }
}
