<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreExportRequest extends FormRequest
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
            'from_date' => 'bail|required|date|date_format:m/d/Y',
            'end_date' => 'bail|required|date|date_format:m/d/Y|after_or_equal:from_date' 
            
            
        ];
    }

    public function message()
    {
        return [
            'end_date.after_or_equal' => 'Please select a valid date', // 
        ];
    }
}
