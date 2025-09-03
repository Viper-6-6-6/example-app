<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// Nếu bạn dùng Sanctum (Breeze hay Jetstream thường dùng):
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các cột có thể fillable (mass assignment).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Các cột cần được ẩn khi serialize (toArray, toJson).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các kiểu dữ liệu cần cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ sẽ tự hash khi gán
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
