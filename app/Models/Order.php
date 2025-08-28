<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    public $timestamps = false;
    protected $fillable = [
        'date',
        'customer_id',
        'amount',
        'status',
        'product_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
