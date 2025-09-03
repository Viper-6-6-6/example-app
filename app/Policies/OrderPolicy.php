<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Xem danh sách hoặc 1 order (mọi role đều xem được).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Order $order): bool
    {
        return true;
    }

    /**
     * Tạo order (admin và staff đều được).
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff']);
    }

    /**
     * Chỉ admin mới có thể sửa.
     */
    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }

    /**
     * Chỉ admin mới có thể xóa.
     */
    public function delete(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }
}
