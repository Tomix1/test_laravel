<?php

namespace App\Http\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptimalProcurementRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'need'           => ['required', 'integer', 'min:1'],
            'offers'         => ['required', 'array'],
            'offers.*.id'    => ['required', 'integer'],
            'offers.*.count' => ['required', 'integer', 'min:1'],
            'offers.*.price' => ['required', 'integer', 'min:1'],
            'offers.*.pack'  => ['required', 'integer', 'min:1'],
        ];
    }
}
