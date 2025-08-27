<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cho phép tất cả (nếu cần check quyền thì sửa ở đây)
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
            'status' => 'required|string',
        ];
    }
}
