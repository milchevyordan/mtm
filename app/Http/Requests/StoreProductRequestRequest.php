<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Warehouse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequestRequest extends FormRequest
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
            'warehouse'             => ['required', Rule::in(Warehouse::values())],
            'products'              => ['array'],
            'products.*.product_id' => ['sometimes', 'required_with:products', 'integer'],
            'products.*.quantity'   => ['sometimes', 'required_with:products', 'integer'],
        ];
    }
}