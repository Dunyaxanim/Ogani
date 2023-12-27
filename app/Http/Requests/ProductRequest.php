<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $data = [
            'img' => [Rule::requiredIf(request()->method == self::METHOD_POST), 'image', 'mimes:jpg,jpeg,png'],
            'stock'=>['required','integer'],
            'discount_price'=>['nullable','min:0'],
            'price'=>['required','numeric','min:1'],
            'category_id'=>['required','exists:categories,id'],
            'measurement'=>['nullable', 'exists:measurements,id'],
            'status'=>['required','boolean'],
            'weight'=>['required','numeric'],
        ];
        return $this->mapLanguageValidations($data);
    }
    private function mapLanguageValidations($data)
    {
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.title"] = "required|string";
            $data["$lang.description"] = "required|string";
            $data["$lang.slug"] = "nullable";
        }
        return $data;
    }
}
