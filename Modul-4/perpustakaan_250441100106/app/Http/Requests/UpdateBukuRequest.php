<?php

namespace App\Http\Requests;

class UpdateBukuRequest extends StoreBukuRequest
{
    public function rules(): array
    {
        return collect(parent::rules())
            ->map(fn ($rules) => array_merge(
                ['sometimes'],
                (array) $rules
            ))
            ->all();
    }
}