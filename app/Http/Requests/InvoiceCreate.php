<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceCreate extends FormRequest
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
        return [
            'customer' => 'required|exists:customers,id',
            'invoiceNumber' => 'required|min:1|unique:invoices,invoiceNumber',
            'invoiceDate' => 'required|date',
            'dueDate' => 'required|date|after_or_equal:invoiceDate',
            'status' => 'required|in:paid,unpaid',

            'cGst' => 'required|numeric|min:0|max:100',
            'sGst' => 'required|numeric|min:0|max:100',
            'iGst' => 'required|numeric|min:0|max:100',

            'product' => 'required|array|min:1',
            'product.*' => 'required|string',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|numeric|min:1',
            'hsnCode' => 'required|array|min:1',
            'hsnCode.*' => 'required|string',
            'unitPrice' => 'required|array|min:1',
            'unitPrice.*' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'product.required' => 'At least one product is required.',
            'product.*.required' => 'Each product name is required.',
            'product.*.string' => 'Each product name must be a string.',
            'quantity.required' => 'At least one quantity is required.',
            'quantity.*.required' => 'Each quantity is required.',
            'quantity.*.numeric' => 'Each quantity must be a number.',
            'quantity.*.min' => 'Each quantity must be at least 1.',
            'unitPrice.required' => 'At least one unit price is required.',
            'unitPrice.*.required' => 'Each unit price is required.',
            'hsnCode.required' => 'At least one HSN code is required.',
            'hsnCode.*.required' => 'Each HSN code is required.',
            'hsnCode.*.string' => 'Each HSN code must be a string.',
            'unitPrice.*.numeric' => 'Each unit price must be a number.',
            'unitPrice.*.min' => 'Each unit price must be at least 0.',
        ];
    }
}
