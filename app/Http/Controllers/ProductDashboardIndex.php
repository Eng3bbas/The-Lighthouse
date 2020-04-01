<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductDashboardIndex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ProductService $productService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(ProductService $productService)
    {
        $products = $productService->all();
        return view('products.dashboard-index',compact('products'));
    }
}
