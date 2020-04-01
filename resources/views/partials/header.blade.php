<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <span class="topbar-child1">
					Free shipping for standard order over $100
				</span>

            <div class="topbar-child2">
                @auth
					<span class="topbar-email">
						{{auth()->user()->email}}
					</span>
                @endauth
            </div>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <a href="/" class="logo">
                {{$appName}}
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="/">Home</a>
                        </li>

                        <li>
                            <a href="{{route("products.index")}}">Shop</a>
                        </li>

                        <li>
                            <a href="{{route('cart.index')}}">Features</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>
                @inject("cart",'App\Services\CartService')
                <span class="linedivide1"></span>

                <div class="header-wrapicon2">
                    <img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{$itemsCount = $cart->getItemsCount()}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        @php($cartItems = $cart->getItems())
                        <ul class="header-cart-wrapitem">
                            @foreach($cartItems as $cartItem)
                            <li class="header-cart-item">
                                <div  class="header-cart-item-img">
                                    <img src="{{asset("storage/" .$cartItem->attributes['image'])}}" alt="{{$cartItem->name}}-IMG">
                                </div>
                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        {{$cartItem->name}}
                                    </a>

                                    <span class="header-cart-item-info">
											{{$cartItem->quantity}} x ${{$cartItem->price}}
										</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="header-cart-total">
                            Total: ${{$cartTotalPrice = $cart->getTotalPrice()}}
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{route('cart.index')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
                                @auth
								    {{auth()->user()->email}}
                                @endauth
							</span>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="/">Home</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{route("products.index")}}">Shop</a>
                </li>


                <li class="item-menu-mobile">
                    <a href="{{route("cart.index")}}">Features</a>
                </li>

            </ul>
        </nav>
    </div>
</header>
