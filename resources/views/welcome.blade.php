@extends("layouts.mainApp",['title' => "HomePage"])
@section("content")
    <!-- Slide1 -->
    <section class="slide1">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1 item1-slick1" style="background-image: url({{"/storage/".$products->random(1)->first()->image}});">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							Women Collection 2018
						</span>

                        <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
                            New arrivals
                        </h2>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                            <!-- Button -->
                            <a href="{{route("products.index")}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="item-slick1 item2-slick1" style="background-image: url({{"/storage/".$products->random(1)->first()->image}});">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
							Women Collection 2018
						</span>

                        <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
                            New arrivals
                        </h2>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
                            <!-- Button -->
                            <a href="{{route("products.index")}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="item-slick1 item3-slick1" style="background-image: url({{"/storage/".$products->random(1)->first()->image}});">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
							Women Collection 2018
						</span>

                        <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight">
                            New arrivals
                        </h2>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
                            <!-- Button -->
                            <a href="{{route("products.index")}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Banner -->
    <section class="banner bgwhite p-t-40 p-b-40">
        <div class="container">
            <div class="row">
                @forelse($categories as $category)
                    @if($loop->even)

                    <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">

                    <!-- block1 -->
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img style="max-width: 50%;max-height: 44%" src="/storage/{{$category->image}}" alt="IMG-BENNER">

                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="{{route('products.by-category',['categoryId' => $category->id])}}" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                {{$category->name}}
                            </a>
                        </div>
                    </div>
                </div>
                    @endif

                        @if($loop->odd)

                            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">

                                <!-- block1 -->
                                <div class="block1 hov-img-zoom pos-relative m-b-30">
                                    <img style="max-width: 50%;max-height: 44%" src="/storage/{{$category->image}}" alt="IMG-BENNER">

                                    <div class="block1-wrapbtn w-size2">
                                        <!-- Button -->
                                        <a href="{{route('products.by-category',['categoryId' => $category->id])}}" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                            {{$category->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <h1>No Categories</h1>
                    @endforelse

            </div>
        </div>
    </section>

    <!-- New Product -->
    <section class="newproduct bgwhite p-t-45 p-b-105">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Featured Products
                </h3>
            </div>

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
