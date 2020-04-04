<?php


namespace App\Repositories;


use App\User;

interface IUserRepository
{
    public function create(array $data) : ?User;

    public function paginated(int $perPage = 10);
    public function update(int $id , array $data):bool ;
    public function count(string $columns = '*') : int ;

    public function delete(int $id);
    public function findOrFail(int $id , array $columns = ['*']) : User;
}
