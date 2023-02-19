<?php

namespace App\Http\Requests;

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
            'name' => 'required | string | unique:tbl_product',
            'sku' => 'required | string | unique:tbl_product',
            'category' => 'required',
            'sub_category' => 'required',
            'size' => 'required',
            'size_unit' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'weight_unit' => 'required',
            'ctn_length' => 'required',
            'ctn_height' => 'required',
            'ctn_width' => 'required',
            'moq' => 'required',
            'moq_unit' => 'required',
            'hs_code' => 'required',
            'barcode' => 'required | unique:tbl_product',
            'description' => 'required',
            'image' => 'required',
        ];
    }
}
