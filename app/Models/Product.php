<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $in_stock
 * @property int $category_id
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'in_stock',
        'category_id',
    ];

    protected $hidden = ["deleted_at"];

    /**
     * Get the category that owns the product.
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
