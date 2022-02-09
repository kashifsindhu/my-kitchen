<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountPricing extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $fillable = [
        'customer_group_id',
        'brand',
        'product_id',
        'ctn_qty',
        'or_more',
        'discount_rate',
        'is_active',
        'start_date',
        'finish_date',
    ];

    public function group()
    {
        return $this->hasOne(GroupCustomer::class, 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }
}