@extends('layouts.dashboard',['title' => "Categories Page"])
@section('content')
    <a href="{{route('categories.create')}}" class="btn btn-primary">Create</a>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Categories Table</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>
                            <form action="{{route('categories.destroy',['id' => $category->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <a href="{{route('categories.edit',['id' => $category->id])}}" class="btn btn-success">Edit</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
