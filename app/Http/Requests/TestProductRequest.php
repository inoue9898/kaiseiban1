<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestProductRequest extends FormRequest
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
            'product_name' => 'required|max:20',
            'company_name' => 'required|max:20',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'required|max:100',
            'image' => 'required|image',
        ];
    }

    public function attributes() {
        return[
            'product_name' => '商品名',
            'company_name' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫',
            'comment' => 'コメント',
            'image' => '画像',
        ];
    }

    public function messages() {
        return [
            'product_name' => ':attributeは必須項目です。',
            'company_name' => ':attributeは必須項目です。',
            'price' => ':attributeは必須項目です。',
            'stock' => ':attributeは必須項目です。',
            'comment' => ':attributeは必須項目です。',
            'image' => ':attributeは必須項目です。',
        ];
    }
}
