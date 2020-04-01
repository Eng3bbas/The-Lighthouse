<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @admin
                <li @active(route('dashboard.index')) class="active" @endactive>
                    <a href="/dashboard/main"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                @endadmin
                <li @active(route('orders.index')) class="active" @endactive>
                    <a href="{{route('orders.index')}}"><i class="menu-icon fa fa-laptop"></i>Orders </a>
                </li>
                @admin
                <li @active(route('dashboard.products')) class="active" @endactive>
                <a href="{{route('dashboard.products')}}"><i class="menu-icon fa fa-laptop"></i>Products </a>
                </li>
                @endadmin
                @admin
                <li @active(route('categories.index')) class="active" @endactive>
                <a href="{{route('categories.index')}}"><i class="menu-icon fa fa-laptop"></i>Categories </a>
                </li>
                @endadmin
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
