<?php


namespace App\Repositories;


use App\Product;
use Storage;

class ProductRepository implements IProductRepository
{
    private Product $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->model->latest('id')->paginate(8);
    }

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function show(int $id): Product
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
        $product = $this->findOrFail($id);
        return $product->update($data);
    }

    /**
     * @param int $id
     * @param array $columns
     * @return Product
     */
    public function findOrFail(int $id ,array $columns = ['*']): Product
    {
        return $this->model->findOrFail($id,$columns);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id) : void
    {
        $product = $this->findOrFail($id);
        $product->delete();
    }
    public function findByCategoryId(int $categoryId)
    {
        return $this->model->where(['category_id' => $categoryId])->paginate(8);
    }
}
