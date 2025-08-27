<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'created_at',
        'updated_at'
    ];

    // Một khách hàng có nhiều đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    // Một khách hàng có thể viết nhiều review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
