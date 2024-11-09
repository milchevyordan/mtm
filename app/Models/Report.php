<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasCreator;

    public const UPDATED_AT = null;
}
