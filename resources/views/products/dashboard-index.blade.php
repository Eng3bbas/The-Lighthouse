@extends('layouts.dashboard',['title' => "Products"])
@section('content')
    <a href="{{route('products.create')}}" class="btn btn-primary">Create</a>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Products Table</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Published At:</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td><span class="count">{{$product->price}}</span></td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->user->name}}</td>
                        <td>{{$product->created_at->format("Y/m/d g:i A")}}</td>
                        <td>
                            <form action="{{route('products.destroy',['id' => $product->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <a href="{{route('products.edit',['id' => $product->id])}}" class="btn btn-success">Edit</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
