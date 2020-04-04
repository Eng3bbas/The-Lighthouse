<?php


namespace App\Services;


use App\Repositories\IUserRepository;
use App\User;
use Illuminate\Support\Str;

class UserService
{
    use Countable,Uploadable,ServiceHelpers;
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data) : ?User
    {
        $data['avatar'] = request()->hasFile('avatar') ?
            $this->uploadImage(request()->file('avatar'),"avatars/" . Str::slug($data['name'])) :
            env("NO_IMAGE_NAME");
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update($id , array $data):void
    {
        $this->idValidator($id);
        if (request()->hasFile('avatar')){
            $file = request()->file('avatar');
            $data['avatar'] = $file->hashName("avatars/" . Str::slug($data['name']) ."/");
        }
        $this->repository->update($id,$data);
    }

    public function paginated(int $perPage = 10)
    {
        return $this->repository->paginated($perPage);
    }

    public function get(int $id) : User
    {
        $this->idValidator($id);
        return $this->repository->findOrFail($id);
    }

    public function delete($id)
    {
        $this->idValidator($id);
        $this->repository->delete($id);
    }
}
