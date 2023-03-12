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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name'=> 'required|string|max:50|unique:products,product_name,'. $this->pro_id,
            'section_id' => 'integer|exists:App\Models\section,id',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages(){
        return [
            'product_name.required'=>'اسم المنتج مطلوب',
            'product_name.unique' => 'اسم المنتج موجود مسبقا',
            'product_name.string' => 'اسم المنتج يجب ان يحتوي حروف',
            'product_name.max' => 'اسم القسم يجب ان لا يتجاوز الخمسين حرف',
            'section_id.exists'=>'القسم غير متوفر',
            'description.required' => 'وصف القسم مطلوب',
            'description.string' => 'وصف القسم يجب ان يحتوي حروف',
            'description.max' => 'وصف القسم يجب ان لا يتجاوز الخمس مئة حرف',
        ];

    }
}
