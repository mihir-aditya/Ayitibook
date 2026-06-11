<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAffiliateLinkRequest extends FormRequest
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
     * affiliate_id is only required when the route does NOT already carry an
     * {affiliate} parameter (e.g. admin creating a link from a generic form).
     * When the route has {affiliate} (affiliate's own modal flow), the ID is
     * taken from the route model binding in the controller, so we skip it here.
     */
    public function rules(): array
    {
        return [
            'product_id'   => 'required|exists:products,id',
            'link_code'    => 'nullable|unique:affiliate_links,link_code',

            'affiliate_id' => $this->route('affiliate')
                ? 'sometimes'                       // route already has affiliate — skip
                : 'required|exists:affiliates,id',  // admin generic form — require it
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'   => 'Please select a product',
            'product_id.exists'     => 'Selected product does not exist',
            'affiliate_id.required' => 'Please select an affiliate',
            'affiliate_id.exists'   => 'Selected affiliate does not exist',
            'link_code.unique'      => 'This link code is already in use',
        ];
    }
}