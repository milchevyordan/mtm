<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ProductType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255', Rule::unique('products')->ignore($this->product->id)],
            'type'             => ['required', Rule::in(ProductType::values())],
            'internal_id'      => ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($this->product->id)],
            'minimum_quantity' => ['nullable', 'integer', 'max:2147483647'],
            'quantities'       => ['required', 'array'],
            'quantities.*'     => ['nullable', 'integer', 'max:2147483647'],
        ];
    }
}
