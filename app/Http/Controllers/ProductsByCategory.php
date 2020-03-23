<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsByCategory extends Controller
{
    /**
     * @param $categoryId
     * @param ProductService $productService
     * @return \Illuminate\Http\Response
     */
    public function __invoke($categoryId , ProductService $productService)
    {
        return response()->view("products.index",[
            'products' => $productService->getByCategoryId($categoryId)
        ]);
    }
}
