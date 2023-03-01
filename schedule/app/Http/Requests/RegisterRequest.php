<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'day1' => 'required',
            'time1',
            'schedule1' => 'required || max:25',

            'day2' => 'required_with:schedule2,time2',
            'time2',
            'schedule2' => 'required_with:day2,time2 || max:25',

            'day3' => 'required_with:schedule3,time3',
            'time3',
            'schedule3' => 'required_with:day3,time3 || max:25',
        ];
    }

    public function attributes()
    {
        return [
            'day1' => '日付',
            'time1',
            'schedule1' => '予定',

            'day2' => '日付',
            'time2',
            'schedule2' => '予定',

            'day3' => '日付',
            'time3',
            'schedule3' => '予定',
        ];
    }
}
