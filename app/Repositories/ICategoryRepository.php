<?php


namespace App\Repositories;


use App\Category;

interface ICategoryRepository
{
    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index();
    public function create(array $data) : Category;
    public function show(int $id) : Category;
    public function findOrFail(int $id,array $columns = ['*']) : Category;
    public function update(int $id , array $data) : bool ;
    public function delete(int $id) : void ;

}
