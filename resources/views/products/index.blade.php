@extends("layouts.mainApp",['title' => "All Products"])
@section("styles")
    <x-styles-loader :styles="['styles/categories','styles/categories_responsive']"></x-styles-loader>
    @endsection
@section("content")
    <div class="row">
        <div class="col">
            <x-all-products :products="$products"></x-all-products>
        </div>
    </div>
@endsection
