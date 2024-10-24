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
        'minimum_quantity',
        'quantity_varna',
        'quantity_france',
        'quantity_netherlands',
    ];

    /**
     * Product quantity in different warehouses.
     *
     * @return HasMany
     */
    public function quantity(): HasMany
    {
        return $this->hasMany(ProductQuantity::class);
    }
}
