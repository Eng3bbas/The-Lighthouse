<?php

namespace App;

use App\Casts\ImageCast;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @mixin \Eloquent
 * @property \App\Casts\ImageCast|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereImage($value)
 */
class Category extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
      'image' => ImageCast::class
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
