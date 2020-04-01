<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(ProductService $productService , CategoryService $categoryService)
    {
        $products  = $productService->all();
        $categories = $categoryService->all();
        return view('welcome',compact('products','categories'));
    }
}
