<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Warehouse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProductToProjectRequest extends FormRequest
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
            'product_id'         => ['required', 'integer'],
            'project_id'         => ['required', 'integer'],
            'quantity'           => ['required', 'integer', 'max:2147483647', 'lte:available_quantity'],
            'available_quantity' => ['required', 'integer'],
            'warehouse'          => ['required', Rule::in(Warehouse::values())],
        ];
    }
}
