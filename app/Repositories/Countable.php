<?php


namespace App\Repositories;


trait Countable
{
    public function count(string $columns = '*') : int
    {
        return $this->model->count($columns);
    }
}
