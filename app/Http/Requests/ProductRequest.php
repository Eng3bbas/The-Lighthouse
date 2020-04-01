<?php

namespace App\Http\Requests;

use App\Product;
use App\Rules\CategoryId;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can("create",Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required','string','max:255'],
            'price' => ['required','integer','min:1'],
            'category_id' => ['required','integer',new CategoryId],
            'image' => ['nullable','image','mimes:jpg,png,jpeg']
        ];
        if ($this->url() === $this->route('products.store'))
            $rules['name'][] = "unique:products";
        return $rules;
    }
}
