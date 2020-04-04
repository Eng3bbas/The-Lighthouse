@extends('layouts.dashboard',['title' => "Users Index"])
@section('content')
    <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Users</strong>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th>Name</th>
                    <th class="avatar">Avatar</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Orders Count</th>
                    <th>Joined At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="serial">{{$user->id}}.</td>
                    <td>{{$user->name}}</td>
                    <td class="avatar">
                        <div class="round-img">
                            <a href="#"><img class="rounded-circle" src="/storage/{{$user->avatar}}" alt=""></a>
                        </div>
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->is_admin ? "Admin" : "User"}}</td>
                    <td>{{$user->orders_count}}</td>
                    <td>{{$user->created_at->format("Y/m/d g:i A")}}</td>
                    <td>
                        <form action="{{route('users.destroy',['id' => $user->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="{{route('users.edit',['id' => $user->id])}}" class="btn btn-success">Edit</a>
                        </form>
                    </td>
                </tr>
                    @empty
                        <h1>No Users</h1>
                @endforelse
                </tbody>
            </table>
            {{$users->links()}}
            <div class="clearfix"></div>
        </div> <!-- /.table-stats -->
    </div>
@endsection
