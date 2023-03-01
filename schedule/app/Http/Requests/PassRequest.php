<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required | email | exists:users,email',
            'new_pass' => 'required | min:8 ',
            'pass_confirmation' => 'required | min:8',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'new_pass' => '新しいパスワード',
            'pass_confirmation' => '確認用パスワード',
        ];
    }
}
