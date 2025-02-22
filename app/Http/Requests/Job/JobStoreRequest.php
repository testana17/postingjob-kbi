<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
            // 'users_id'  => 'required|exists:users,id',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gaji'      => 'required|numeric|min:0',
            'kategori'  => 'required|string|max:100',
            'type' => 'required|in:Remote,FullTime,Parttime,Contract',
            'lokasi'    => 'required|string|max:255',
        ];
    }
}
