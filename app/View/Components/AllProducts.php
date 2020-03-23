<?php

namespace App\View\Components;

use App\Product;
use App\Services\ProductService;
use Illuminate\View\Component;

class AllProducts extends Component
{
    public $products;
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.all-products');
    }
}
