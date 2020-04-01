<?php


namespace App\Repositories;


use App\User;

interface IUserRepository
{
    public function create(array $data) : ?User;

    public function update(int $id , array $data):bool ;
    public function count(string $columns = '*') : int ;

}
