<?php


namespace App\Services;


use App\Repositories\IProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    use ServiceHelpers;
    private IProductRepository $repository;
    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return $this->repository->index();
    }
    public function create(Request $request)
    {
        $data = $request->only(['name','price','category_id']);
        $data['image'] = env("NO_IMAGE_NAME");
        $data['user_id'] = auth()->id();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $data['image'] = $file->hashName("products/");
        }
        return $this->repository->create($data);
    }

    public function show($id)
    {
        $this->idValidator($id);
        return $this->repository->show($id);
    }

    public function update($id , Request $request)
    {
        $this->idValidator($id);
        abort_if(!auth()->user()->can("update",$this->repository->show($id)),403,'You are not an admin');
        $data = $request->only(['name','price','category_id']);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $data['image'] = $file->hashName("products/");
        }
        return $this->repository->update($id,$data);
    }

    public function delete($id)
    {
        $this->idValidator($id);
        abort_if(!auth()->user()->can("delete",$this->repository->show($id)),403,'You are not an admin');
        $this->repository->delete($id);
    }

    public function getByCategoryId($categoryId)
    {
        $this->idValidator($categoryId);
        return $this->repository->findByCategoryId($categoryId);
    }
}
