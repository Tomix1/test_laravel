<?php

namespace App\Http\Requests;

use App\Models\CarModel;
use App\Models\JobTitle;
use Illuminate\Foundation\Http\FormRequest;

class AvailableCarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'started_at'   => [
                'required',
                'date_format:Y-m-d H:i:s',
            ],
            'finished_at'  => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after_or_equal:started_at',
            ],
            'car_model_id' => [
                'sometimes',
                'string',
                'exists:' . CarModel::class . ',id',
            ],
            'job_title_id' => [
                'sometimes',
                'int',
                'exists:' . JobTitle::class . ',id',
            ],
        ];
    }
}
