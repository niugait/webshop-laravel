<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property float $discount
 * @property bool $is_percentage
 * @property string $expires_at
 * @property bool $is_active
 * @property int $category_id
 */
class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'discount',
        'is_percentage',
        'expires_at',
        'is_active',
        'category_id',
    ];

    protected $hidden = ["deleted_at"];

    protected $dates = [
        'expires_at',
    ];
}
