<?php


namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Storage;

class ImageCast implements CastsAttributes
{

    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (($value != null || env("NO_IMAGE_NAME")) &&  ($originalImage = $model->getOriginal($key)))
            Storage::delete($originalImage);
        return $value;
    }
}
