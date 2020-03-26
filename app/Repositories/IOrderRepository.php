<?php


namespace App\Repositories;


use App\Order;

interface IOrderRepository
{
    public function getAllOrders();

    public function create(array $data,array $products) : Order;

    public function findOrFail(int $id , array $columns = ['*']) : Order;

    public function delete(int $id) : void;

    public function update(int $id , array $data) : bool ;

    public function getByUserId(int $id);
}
