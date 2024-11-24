<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ProductRequestStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequestRequest extends FormRequest
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
            'status'                     => ['required', Rule::in(ProductRequestStatus::values())],
            'products'                   => ['array'],
            'products.*.id'              => ['required', 'integer'],
            'products.*.product_id'      => ['required', 'integer'],
            'products.*.quantity'        => ['required', 'integer'],
            'products.*.actual_quantity' => [
                'nullable', 'integer',
                Rule::requiredIf(fn () => request('status') === ProductRequestStatus::Accepted->value),
            ],
        ];
    }
}
