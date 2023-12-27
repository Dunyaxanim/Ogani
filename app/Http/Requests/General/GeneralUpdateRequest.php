<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class GeneralUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->id,
            'open_time' => ['nullable', 'date'],
            'phone' => ['required'],
        ];
        return $this->mapLanguageValidations($data);
    }
    
    private function mapLanguageValidations($data)
    {
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.company_name"] = [
                'string',
                Rule::unique('general_translations', 'company_name')
                    ->where('locale', $lang)->ignore($this->id, 'id')
            ];
            // $data["$lang.address"] = "required|string";
            // $data["$lang.title"] = "required|string";
        }
        return $data;
    }
}
