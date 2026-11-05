<?php

namespace App\Http\Requests\OMC;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
{
    /**
     * Izinkan user untuk melakukan request ini.
     */
    public function authorize(): bool
    {
        return true; // Set ke true agar bisa digunakan
    }

    /**
     * Aturan validasi untuk Multi-Bahasa dan File.
     */
    public function rules(): array
    {
        return [
            'type' => 'required|string|max:100',
            'title_id' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'desc_id' => 'required|string',
            'desc_en' => 'required|string',
            'content_id' => 'nullable|string',
            'content_en' => 'nullable|string',
            'banner' => 'required|image|mimes:jpg,jpeg,png|max:3072', // Max 3MB
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // Max 10MB
            'published_at' => 'required|date',
        ];
    }

    /**
     * Kustomisasi pesan error (Opsional agar lebih user-friendly)
     */
    public function messages(): array
    {
        return [
            'title_id.required' => 'Judul versi Indonesia wajib diisi.',
            'title_en.required' => 'Judul versi Inggris wajib diisi.',
            'banner.required' => 'Banner utama wajib diunggah.',
            'banner.max' => 'Ukuran banner maksimal 3MB.',
        ];
    }
}
