<?php

namespace App\Observers;

use App\Category;
use App\Jobs\DeleteImage;

class CategoryObserver
{

    public function updated(Category $category)
    {
        $originalAvatar = $category->getOriginal('image');
        if ($originalAvatar !== env('NO_IMAGE_NAME') || $originalAvatar != null)
           DeleteImage::dispatchNow($originalAvatar);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleting(Category $category)
    {
        if ($category->has("products"))
           DeleteImage::dispatch($category->products()->pluck('image')->all());
    }

    public function deleted(Category $category) : void
    {
        $originalAvatar = $category->getOriginal('image');
        if ($originalAvatar !== env('NO_IMAGE_NAME') || $originalAvatar != null)
            DeleteImage::dispatchNow($originalAvatar);
    }
}
