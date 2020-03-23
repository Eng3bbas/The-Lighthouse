<?php


namespace App\Services;


use App\Repositories\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    use ServiceHelpers;
    private ICategoryRepository $repository;
    public function __construct(ICategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->index();
    }

    public function create(Request $request)
    {
        return $this->repository->create($request->only('name'));
    }

    public function show($id)
    {
        $this->idValidator($id);
        return $this->repository->findOrFail($id);
    }

    public function update($id , Request $request)
    {
        $this->idValidator($id);
        return $this->repository->update($id,$request->only('name'));
    }

    public function delete($id)
    {
        $this->idValidator($id);
        abort_if(!auth()->user()->is_admin,403);
        $this->repository->delete($id);
    }

    public function limitCategories(int $limit)
    {
        return $this->all()->take($limit)->values();
    }
}
