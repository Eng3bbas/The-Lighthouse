<?php


namespace App\Repositories;


use App\User;
use DB;
use Storage;
use Throwable;

class UserRepository implements IUserRepository
{

    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return User|null
     * @throws Throwable
     */
    public function create(array $data): ?User
    {
        DB::beginTransaction();
        try {
            $user =  $this->model->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'avatar' => $data['avatar'] ?? env("NO_IMAGE_NAME")
            ]);
            DB::commit();
            return $user;
        }
        catch (Throwable $exception){
            if (isset($data['avatar']))
                Storage::delete($data['avatar']);
            DB::rollBack();
            abort(500,$exception->getMessage());
        }
    }
    public function update(int $id, array $data): bool
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
