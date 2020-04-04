<?php


namespace App\Repositories;


use App\User;
use DB;
use Storage;
use Throwable;

class UserRepository implements IUserRepository
{
    use Countable;
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
                'avatar' => $data['avatar']
            ]);
            DB::commit();
            return $user;
        }
        catch (Throwable $exception){
            if (isset($data['avatar']))
                Storage::delete($data['avatar']);
            abort(500,$exception->getMessage());
        }
    }
    public function update(int $id, array $data): bool
    {
        return $this->model->findOrFail($id)->update($data);
    }
    public function paginated(int $perPage = 10)
    {
        return $this->model->latest('id')->withCount('orders')->paginate($perPage);
    }
    public function findOrFail(int $id, array $columns = ['*']) : User
    {
        return $this->model->findOrFail($id,$columns);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $this->findOrFail($id)->delete();
    }
}
