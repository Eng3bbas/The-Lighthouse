@extends('layouts.dashboard',['title' => "Create Product Page"])
@section('content')
    <div class="card">
        <form action="{{route('products.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card-header">
                <strong>Create Product</strong><small> Form</small><br>
            </div>
            <div class="card-body card-block">
                @include('partials.validation-errors')
                <div class="form-group"><label for="name"  class=" form-control-label">Name</label><input required type="text" name="name" id="name" placeholder="Enter your product  name" class="form-control"></div>
                <div class="form-group"><label for="price" class=" form-control-label">Price</label><input required type="number" name="price" id="price" placeholder="11" class="form-control"></div>
                <div class="form-group"><label for="category" class=" form-control-label">Category</label>
                    <select required class="form-control"  name="category_id" id="category">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
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
