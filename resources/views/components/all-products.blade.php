<div class="product_grid" style="position: relative; height: 885px;">
    @forelse($products as $product)
        <div class="product" style="position: absolute; left: 0px; top: 0px;">
            <div class="product_image"><img src="{{asset("storage/no" . ($product->image ?? "noimage.png"))}}" alt=""></div>
            <div class="product_extra product_new"><a href="categories.html">{{$product->category->name}}</a></div>
            <div class="product_content">
                <div class="product_title"><a href="product.html">{{$product->name}}</a></div>
                <div class="product_price">${{$product->price}}</div>
            </div>
        </div>
    @empty
        <h1>No Products</h1>
    @endforelse
        @if(Route::current()->uri !== "/")
            {{$products->withQueryString()->links("assets.pagination")}}
        @endif
</div>
