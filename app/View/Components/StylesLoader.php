<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StylesLoader extends Component
{
    public array $styles = [
        '/styles/bootstrap4/bootstrap.min',
        '/plugins/font-awesome-4.7.0/css/font-awesome.min',
        '/plugins/OwlCarousel2-2.2.1/owl.carousel',
        '/plugins/OwlCarousel2-2.2.1/owl.theme.default',
        '/plugins/OwlCarousel2-2.2.1/animate',
        ];

    /**
     * Create a new component instance.
     *
     * @param array $styles
     */
    public function __construct(array $styles)
    {
        array_push($this->styles,...$styles);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.styles-loader');
    }
}
