<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ChangeLog extends Model
{
    use HasCreator;
    use HasUuid;

    /**
     * Set eloquent to not increment.
     *
     * @return MorphMany
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $primaryKey = 'uuid';

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
}
