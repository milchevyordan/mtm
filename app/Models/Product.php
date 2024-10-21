<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasChangeLogs;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;

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
        'minimum_quantity',
        'quantity_france',
        'quantity_netherlands',
    ];
}
