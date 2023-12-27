<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductImgRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd(request());
        return [
            'product_id'=>['required','exists:products,id'],
            'img' => [Rule::requiredIf(request()->method == self::METHOD_POST), 'image', 'mimes:jpg,jpeg,png'],
        ];
    }
}
