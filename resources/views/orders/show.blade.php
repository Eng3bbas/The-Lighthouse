@extends('layouts.dashboard',['title' => "Orders Index"])
@section('content')
    @admin
    @php($user = $order->user)
    <div class="card">
        <div class="card-header">
            <strong class="card-title">User</strong>
        </div>
        <div class="card-body">
            <h1>Name : {{$user->name}}</h1>
            <div class="avatar">
                <div class="round-img">
                    <a href="#"><img class="rounded-circle" src="/storage/{{$user->avatar}}" alt=""></a>
                </div>
            </div>
            <h2>Email : {{$user->email}}</h2>
        </div>
    </div>
    @endadmin
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Order</strong>
        </div>
        <div class="card-body">
            <h1>Date : {{$order->created_at}}</h1>
            <div class="avatar">
                <div class="round-img">
                    <a href="#"><img class="rounded-circle" src="/storage/{{$user->avatar}}" alt=""></a>
                </div>
            </div>
            <h2>Total Money : {{$order->total_money}}</h2>
            <h3>Address : {{$order->address}}</h3>
            <p>Notes : {{$order->notes}}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products</strong>
        </div>
        <div class="table-stats order-table ov-h">
            <table class="table">
                <thead>
                <tr>
                    <th class="serial">#</th>
                    <th class="avatar">Product Avatar</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>

                @forelse($order->products as $product)
                    <tr>
                        <td class="serial">{{$product->id}}.</td>
                        <td class="avatar">
                            <div class="round-img">
                                <a href="#"><img class="rounded-circle" src="/storage/{{$product->image}}" alt=""></a>
                            </div>
                        </td>
                        <td><span class="count">{{$product->pivot->quantity}}</span></td>
                        <td><span class="count">{{$product->price}}</span></td>
                    </tr>
                @empty
                    <h1>No Orders</h1>
                @endforelse
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div> <!-- /.table-stats -->
    </div>
@endsection
