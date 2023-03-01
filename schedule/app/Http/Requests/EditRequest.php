<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'day' => 'required',
            'time',
            'schedule' => 'required || max:25',
        ];
    }

    public function attributes()
    {
        return [
            'day' => '日付',
            'time',
            'schedule' => '予定',
        ];
    }
}
