<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductType;
use App\Enums\Warehouse;
use App\Traits\HasChangeLogs;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasCreator;
    use HasChangeLogs;
    use SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'internal_id',
        'minimum_quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => ProductType::class,
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

    /**
     * Product quantity in Varna.
     *
     * @return mixed
     */
    public function quantityVarna(): mixed
    {
        return $this->quantity()->where('warehouse', Warehouse::Varna->value);
    }

    /**
     * Product quantity in France.
     *
     * @return mixed
     */
    public function quantityFrance(): mixed
    {
        return $this->quantity()->where('warehouse', Warehouse::France->value);
    }

    /**
     * Product quantity in the Netherlands.
     *
     * @return mixed
     */
    public function quantityNetherlands(): mixed
    {
        return $this->quantity()->where('warehouse', Warehouse::Netherlands->value);
    }

    /**
     * Relation to the projects that this product has been added to.
     *
     * @return BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'product_projects');
    }
}
