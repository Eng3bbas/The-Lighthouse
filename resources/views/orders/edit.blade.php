@extends('layouts.dashboard',['title' => "Edit Order Page"])
@section('content')
    <div class="card">
        <form action="{{route('orders.update',['id' => $order->id])}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="card-header">
                <strong>Edit Order</strong><small> Form</small><br>
            </div>
            <div class="card-body card-block">
                @include('partials.validation-errors')
                <div class="form-group"><label for="address"   class=" form-control-label">Address</label><input value="{{$order->address}}" required type="text" name="address" id="address" placeholder="Enter your Address" class="form-control"></div>
                <div class="form-group"><label for="notes" class=" form-control-label">Notes</label><textarea
                        name="notes"
                        id="notes"
                        cols="30"
                        rows="10"
                        class="form-control">{{$order->notes}}</textarea></div>
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
