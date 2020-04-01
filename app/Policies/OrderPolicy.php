<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user != null;
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function update(User $user, Order $order)
    {
        return $this->deleteOrUpdateCondition($user,$order) ;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function delete(User $user, Order $order)
    {
        return $this->deleteOrUpdateCondition($user,$order);
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    private function deleteOrUpdateCondition(User $user, Order $order) : bool
    {
        return  $user->is_admin || ($order->created_at->diffInDays(now()) <= 0 && $order->user_id === $user->id );
    }
}
