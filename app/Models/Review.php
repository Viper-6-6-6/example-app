<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'content',
    ];

    // Review thuộc về 1 khách hàng
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Review thuộc về 1 sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
