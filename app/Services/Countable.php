<?php


namespace App\Services;


trait Countable
{
    public function count(string $columns = '*')
    {
        return $this->repository->count($columns);
    }
}
