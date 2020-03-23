<?php


namespace App\Services;


use App\Repositories\IUserRepository;
use App\User;
use Illuminate\Support\Str;

class UserService
{
    private IUserRepository $repository;
    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data) : ?User
    {
        if (request()->hasFile('avatar')){
            $file = request()->file('avatar');
            $data['avatar'] = $file->hashName("avatars/" . Str::slug($data['name']) ."/");
        }
        return $this->repository->create($data);
    }

    public function update(int $id , array $data):void
    {
        abort_if(!auth()->user()->is_admin,403,'Not Authorized to update this user' );
        if (request()->hasFile('avatar')){
            $file = request()->file('avatar');
            $data['avatar'] = $file->hashName("avatars/" . Str::slug($data['name']) ."/");
        }
        $this->repository->update($id,$data);
    }
}
