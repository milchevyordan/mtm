<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductRequestStatus;
use App\Enums\Warehouse;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRequest extends Model
{
    use HasCreator;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warehouse',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'warehouse' => Warehouse::class,
        'status'    => ProductRequestStatus::class,
    ];

    /**
     * Return products in this product request.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_product_requests');
    }

    /**
     * Return products in this product request.
     *
     * @return HasMany
     */
    public function productProductRequest(): HasMany
    {
        return $this->hasMany(ProductProductRequest::class);
    }

    /**
     * Return relation that will be used in change log.
     *
     * @return HasManyThrough
     */
    public function productQuantities(): HasManyThrough
    {
        return $this->hasManyThrough(
            ProductQuantity::class,
            ProductProductRequest::class,
            'product_request_id',
            'product_id',
            'id',
            'product_id'
        )->where('product_quantities.warehouse', $this->warehouse);
    }
}
