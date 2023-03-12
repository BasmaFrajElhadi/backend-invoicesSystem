<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
                'section_name' => 'required||string|max:50|unique:sections,section_name,'.$this->id,
                'description' => 'required|string|max:500',
        ];
    }

    public function messages(){
        return [
            'section_name.required' => 'اسم القسم مطلوب',
            'section_name.unique' => 'اسم القسم موجود مسبقا',
            'section_name.string' => 'اسم القسم يجب ان يحتوي حروف',
            'section_name.max' => 'اسم القسم يجب ان لا يتجاوز الخمسين حرف',
            'description.required' => 'وصف القسم مطلوب',
            'description.string' => 'وصف القسم يجب ان يحتوي حروف',
            'description.max' => 'وصف القسم يجب ان لا يتجاوز الخمس مئة حرف',
        ];
    }
}
