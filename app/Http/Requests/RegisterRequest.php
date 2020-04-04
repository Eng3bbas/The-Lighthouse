<?php

namespace App\Http\Requests;

use App\Rules\UserEmail;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $this->url() === route('register') || $this->url() === route('users.create') ?  'unique:users' : new UserEmail],
            'password' => [$this->isMethod('put') ? 'nullable' : 'required', 'string', 'min:7', 'confirmed'],
            'avatar' => ['nullable','image','mimes:jpg,png,jpeg']
        ];
    }
}
