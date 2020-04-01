<?php

namespace App\Observers;

use App\Jobs\DeleteImage;
use App\Product;

class ProductObserver
{
    public function updated(Product $product)
    {
        $originalAvatar = $product->getOriginal('image');
        if ($originalAvatar !== env('NO_IMAGE_NAME') || $originalAvatar != null)
            DeleteImage::dispatchNow($originalAvatar);
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $originalAvatar = $product->getOriginal('image');
        if ($originalAvatar !== env('NO_IMAGE_NAME') || $originalAvatar != null)
            DeleteImage::dispatchNow($originalAvatar);
    }

}
