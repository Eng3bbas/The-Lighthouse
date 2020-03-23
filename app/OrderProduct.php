<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\OrderProduct
 *
 * @property int $order_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereProductId($value)
 * @mixin \Eloquent
 * @property int $quantity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereQuantity($value)
 */
class OrderProduct extends Pivot
{
    public $timestamps = false;
}
