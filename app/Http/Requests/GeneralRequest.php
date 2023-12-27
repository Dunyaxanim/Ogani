<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;
class GeneralRequest extends FormRequest
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
        
        $data = [
            'logo_img' => [Rule::requiredIf(request()->method == self::METHOD_POST), 'image', 'mimes:jpg,jpeg,png'],
            'email'=>['required','email'],
            'open_time' => [Rule::requiredIf(request()->method == self::METHOD_POST)],
            'phone' => ['required'],
            'shipping_price'=>['nullable'],
        ];
        return $this->mapLanguageValidations($data);
    }
    private function mapLanguageValidations($data)
    {
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.company_name"] = "string|required|max:255";
            $data["$lang.address"] = "required|string";
            $data["$lang.title"] = "required|string";
        }
        return $data;
    }
}
