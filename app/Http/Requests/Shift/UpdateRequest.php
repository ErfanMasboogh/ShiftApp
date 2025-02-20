<?php

namespace App\Http\Requests\Shift;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:64'],
            'start' => 'required',
            'end' => 'required',
            'wage_per_hour' => 'required|numeric|min:0|max:1000',
        ];
    }

    protected function prepareForValidation(): void
    {
        $start = $this->input('start');
        $end = $this->input('end');
        if (preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $start)) {
            $this->merge(['start' => $start . ':00']);
        }
        if (preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $end)) {
            $this->merge(['end' => $end . ':00']);
        }
    }
}
