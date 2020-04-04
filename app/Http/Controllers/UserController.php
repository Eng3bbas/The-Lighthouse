<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private const INDEX_NAME = "users.index";
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('users.index',['users' => $this->service->paginated()]) ;
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        if ($request->has('role') && $request->role == 1)
            $data['role'] = true;
        $this->service->create($data);
        return $this->redirectToIndex();
    }

    public function edit($id)
    {
        return view('users.edit',['user' => $this->service->get($id)]);
    }

    public function update($id , RegisterRequest $request)
    {
        $data = $request->validated();
        $data['role'] = $request->has('role') && $request->role == 1;
        $this->service->update($id,$data);
        return $this->redirectToIndex();
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return $this->redirectToIndex();
    }

    private function redirectToIndex()
    {
        return redirect()->route(self::INDEX_NAME);
    }
}
