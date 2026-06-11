<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $productId = $this->route('product');

        // Detect if variants exist
        $hasVariants = is_array($this->variants) && count($this->variants) > 0;

        return [

            /* =========================
             | BASIC PRODUCT
             ========================= */
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'currency' => ['required', 'string', 'size:3'],

            /* =========================
             | MAIN PRODUCT (ONLY IF NO VARIANTS)
             ========================= */
            'sku' => array_filter([
                $hasVariants ? 'nullable' : 'required',
                'string',
                'max:100',
                Rule::unique('products', 'sku')
                    ->where(fn ($q) => $q->where('seller_id', auth('seller')->id())
                    )
                    ->ignore($productId),
            ]),

            'price' => [
            'required_without:variants',
            'nullable',
            'numeric',
            'min:0',
        ],

            'affiliate_percentage' => [
            'nullable',
            'numeric',
            'min:0',
            'max:100',
        ],

            'stock_quantity' => [
            'required_without:variants',
            'nullable',
            'integer',
            'min:0',
        ],

            /* =========================
         | MEDIA
         ========================= */
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:20480'],
            'videos.*' => [
            'nullable',
            'mimetypes:video/mp4,video/webm,video/ogg',
            'max:100480',
        ],

            /* =========================
         | FLAGS
         ========================= */
            'is_active' => ['nullable', 'boolean'],

            /* =========================
         | VARIANTS
         ========================= */
            'variants' => ['nullable', 'array'],

            'variants.*.variant_name' => [
            'required_with:variants',
            'string',
            'max:255',
        ],

            'variants.*.sku' => [
            'nullable',
            'string',
            'max:100',
            'distinct',
        ],

            'variants.*.price' => [
            'required_with:variants',
            'numeric',
            'min:0',
        ],

            'variants.*.quantity' => [
            'required_with:variants',
            'integer',
            'min:0',
        ],

            'variants.*.images' => ['nullable', 'array'],
            'variants.*.images.*' => ['image', 'max:20480'],

            'variants.*.videos' => ['nullable', 'array'],
            'variants.*.videos.*' => [
            'mimetypes:video/mp4,video/webm,video/ogg',
            'max:102400',
        ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
