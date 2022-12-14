<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar'    => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'username'  => [
                'required', 'alphadash',
                Rule::when(request()->isMethod('POST'), Rule::unique('users')),
                Rule::when(request()->isMethod('PUT'), Rule::unique('users')->ignore($this->user)),
            ],
            'email'     => [
                'required', 'email',
                Rule::when(request()->isMethod('POST'), Rule::unique('users')),
                Rule::when(request()->isMethod('PUT'), Rule::unique('users')->ignore($this->user)),
            ],
            'password'  => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'nullable'),
                'min:6'
            ],
        ];
    }
}
