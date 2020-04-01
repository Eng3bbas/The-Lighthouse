<?php
use \Illuminate\Support\Str;
if (!function_exists('is_item_active'))
{
    function is_item_active(string $url) : bool
    {
        return Str::contains(url()->current(),$url);
    }
}
