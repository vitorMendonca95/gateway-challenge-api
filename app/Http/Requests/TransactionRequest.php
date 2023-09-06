<?php

namespace App\Http\Requests;

use App\Enums\PaymentTypesEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TransactionRequest extends FormRequest
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
            'forma_pagamento' => [new Enum(PaymentTypesEnum::class)],
            'conta_id' => 'required|numeric',
            'valor' => 'required|numeric|gt:0'
        ];
    }
}
