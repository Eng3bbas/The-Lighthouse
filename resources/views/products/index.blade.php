@extends("layouts.mainApp",['title' => "All Products"])
@section("content")
    <section class="newproduct bgwhite p-t-45 p-b-105">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Featured Products
                </h3>
            </div>
            <h2>{{$products->count() . ($products->count() <= 1 ? " Product" : " Products")}} found</h2>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    <x-all-products :products="$products"></x-all-products>
                </div>
            </div>
            {{$products->withQueryString()->links()}}
        </div>
    </section>
@endsection
