<?php


namespace App\Repositories;


use App\Product;

interface IProductRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index();

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data) : Product;

    /**
     * @param int $id
     * @return Product
     */
    public function show(int $id) : Product;

    /**
     * @param int $id
     * @param array $columns
     * @return Product
     */
    public function findOrFail(int $id,array $columns = ['*']) : Product;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id , array $data) : bool ;

    /**
     * @param int $id
     */
    public function delete(int $id) : void ;
    /**
     * @param int $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByCategoryId(int $categoryId);

    public function count(string $columns = '*') : int ;

}
