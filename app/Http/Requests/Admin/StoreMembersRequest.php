<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembersRequest extends FormRequest
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
            'name' => 'nullable',
            'company' => 'nullable',
            'date_avail' => 'nullable',
            'provider' => 'nullable',
            'type_avail' => 'nullable',
            'amount' => 'nullable',
            'batch_num' => 'nullable',
            'check_num' => 'nullable',
            'check_am' => 'nullable',
            'check_date' => 'nullable',

        ];
    }
}
