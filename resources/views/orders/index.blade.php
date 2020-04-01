@extends('layouts.dashboard',['title' => "Orders Index"])
@section('content')

    <div class="card">
        <div class="card-header">
            <strong class="card-title">Orders</strong>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th class="avatar">User Avatar</th>
                    @admin
                    <th>User Name</th>
                    @endadmin
                    <th>Products Count</th>
                    <th>Total Money</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="serial">{{$order->id}}.</td>
                    <td class="avatar">
                        <div class="round-img">
                            <a href="#"><img class="rounded-circle" src="/storage/{{$order->user->avatar}}" alt=""></a>
                        </div>
                    </td>
                    @admin
                    <td>  <span class="name">{{$order->user->name}}</span> </td>
                    @endadmin
                    <td><span class="count">{{$order->products_count}}</span></td>
                    <td><span class="count">{{$order->total_money}}</span></td>
                    @update_delete_order($order->created_at)
                    <td>
                        <form action="{{route('orders.destroy',['id' => $order->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
{{--                            <a href="{{route('orders.edit')}}" class="btn btn-success">Edit</a>--}}
                        </form>
                    </td>
                    @endupdate_delete_order
                </tr>
                    @empty
                        <h1>No Orders</h1>
                @endforelse
                </tbody>
            </table>
            {{$products->links()}}
            <div class="clearfix"></div>
        </div> <!-- /.table-stats -->
    </div>
@endsection
