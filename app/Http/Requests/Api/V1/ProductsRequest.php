<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function wantsJson()
    {
        return true;
    }

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
        switch ($this->method()) {
            case 'POST':
                return [
                    'sku' => 'required|min:1',
                    'name' => 'required',
                    'price' => 'required',
                    'weight' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'sku' => 'sometimes|min:1',
                    'name' => 'sometimes',
                    'price' => 'sometimes',
                    'weight' => 'sometimes',
                ];
                break;
        }
    }
}
