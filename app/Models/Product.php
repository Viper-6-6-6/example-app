<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    // Sản phẩm thuộc 1 category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Sản phẩm có nhiều order (quan hệ thông qua bảng orders)
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    // Sản phẩm có nhiều review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
