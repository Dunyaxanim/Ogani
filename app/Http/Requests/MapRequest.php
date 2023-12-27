<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapRequest extends FormRequest
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
            'phone'=>['required','string'],
            'link'=>['required','string','max:3000'],
        ];
        return $this->mapLanguageValidations($data);
    }

    private function mapLanguageValidations($data)
    {
        foreach (config('translatable.locales') as $lang) {
            $data[$lang] = 'required|array';
            $data["$lang.country"] = "required|string";
            $data["$lang.address"] = "required|string";
        }
        return $data;
    }
}
