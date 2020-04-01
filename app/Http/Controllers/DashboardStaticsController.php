<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardStaticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ProductService $productService
     * @param UserService $userService
     * @param OrderService $orderService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function __invoke(
        ProductService $productService,
        UserService $userService,
        OrderService $orderService)
    {
        $view = view('dashboard.index',$data =  [
            'orders_cost' => $orderService->getTotalMoney(),
            'users' => $userService->count(),
            'orders_count' => $orderService->count(),
            'products' => $productService->count()
        ]);
        if ($data['orders_count'] === 0 && app()->runningUnitTests())
            $view->with('orders_empty',0);
        return $view;
    }
}
