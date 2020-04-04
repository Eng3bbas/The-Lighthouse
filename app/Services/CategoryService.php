<?php


namespace App\Services;


use App\Repositories\ICategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class CategoryService
{
    use ServiceHelpers, Countable, Uploadable;
    private const UPLOAD_DIR = "categories";
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
        $data = $request->only('name');
        if ($request->hasFile('image'))
            $data['image'] = $this->uploadImage($request->file('image'), self::UPLOAD_DIR);
        return $this->repository->create($data);
    }

    public function show($id)
    {
        $this->idValidator($id);
        return $this->repository->findOrFail($id);
    }

    public function update($id, Request $request)
    {
        $this->idValidator($id);
        $data = $request->only('name');
        if ($request->hasFile('image'))
            $data['image'] = $this->uploadImage($request->file('image'), self::UPLOAD_DIR);
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $this->idValidator($id);
        abort_if(!auth()->user()->is_admin, 403);
        $this->repository->delete($id);
    }


}
