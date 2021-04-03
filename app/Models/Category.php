<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = ["deleted_at"];

    /**
     * Get the products for the category.
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
