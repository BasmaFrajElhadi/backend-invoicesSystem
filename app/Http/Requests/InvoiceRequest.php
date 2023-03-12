<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'invoice_number' => 'required',
            'invoice_Date' => 'required',
            'Due_date' => 'required',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required',
            'Amount_Commission' => 'required',
            'Rate_VAT' => 'required',
            'Value_VAT' => 'required',
            'Total' => 'required',
            'pic' => 'mimes:pdf,jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'invoice_number.required' => 'رقم الفاتورة مطلوب',
            'invoice_Date.required' => 'تاريخ الفاتورة مطلوب',
            'Due_date.required' => 'تاريخ استحقاق الفاتورة مطلوب',
            'product.required' => 'المنتج مطلوب',
            'Section.required' => 'القسم مطلوب',
            'Amount_collection.required' => 'مبلغ التحصيل مطلوب',
            'Amount_Commission.required' => 'مبلغ العمولة مطلوب',
            'Rate_VAT.required' => 'نسبة الضريبة مطلوبه',
            'Value_VAT.required' => 'قيمة الضريبة المضافة مطلوبه',
            'Total.required' => 'القيمة الكلية مطلوبه',
            'pic.mimes' => 'صيغة الملف غير صحيحة',
        ];
    }
}
