<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            //
            'judul'     => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string',
            'gaji'      => 'sometimes|numeric|min:0',
            'kategori'  => 'sometimes|string|max:100',
            'type' => 'sometimes|in:Remote,FullTime,Parttime,Contract',
            'lokasi'    => 'sometimes|string|max:255',
        ];
    }
}
