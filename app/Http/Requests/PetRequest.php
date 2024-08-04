<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'category_id' => 'nullable|integer',
            'category_name' => 'nullable|string',
            'name' => 'required|string',
            'photoUrls' => 'nullable|string',
            'tags' => 'nullable|string',
            'status' => 'required|string|in:available,pending,sold',
        ];
    }
}
