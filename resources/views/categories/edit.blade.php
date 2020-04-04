@extends('layouts.dashboard',['title' => "Edit Category Page"])
@section('content')
    <div class="card">
        <form action="{{route('categories.update',['id' => $category->id])}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="card-header">
                <strong>Edit Category</strong><small> Form</small><br>
            </div>
            <div class="card-body card-block">
                @include('partials.validation-errors')
                <div class="form-group"><label for="name"   class=" form-control-label">Name</label><input value="{{$category->name}}" required type="text" name="name" id="name" placeholder="Enter your category  name" class="form-control"></div>
                <div class="form-group"><label for="image" class=" form-control-label">Image</label><input type="file" id="image" name="image" class="form-control"></div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Submit
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> Reset
                </button>
            </div>
        </form>

    </div>
@endsection
