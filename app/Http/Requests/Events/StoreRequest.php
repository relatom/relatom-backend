<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => ['nullable','string','max:255'],
            'is_all_day' => ['required','boolean'],
            'starts_at' => ['required','date'],
            'ends_at' => ['required','date', request('is_all_day') ? 'after_or_equal:starts_at' : 'after:starts_at'],
            'notes' => ['nullable','string'],
        ];
    }
}
