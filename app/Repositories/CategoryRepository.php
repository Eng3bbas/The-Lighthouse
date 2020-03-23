<?php


namespace App\Repositories;


use App\Category;

class CategoryRepository implements ICategoryRepository
{
    private Category $model;
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->model->latest("id")->get();
    }

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function show(int $id): Category
    {
        return $this->findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $category = $this->findOrFail($id);
        return $category->update($data);
    }

    /**
     * @param int $id
     * @param array $columns
     * @return Category
     */
    public function findOrFail(int $id ,array $columns = ['*']): Category
    {
        return $this->model->findOrFail($id,$columns);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id) : void
    {
        $category = $this->findOrFail($id);
        $category->delete();
    }

}
