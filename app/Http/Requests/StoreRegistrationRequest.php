<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public form
    }

    public function rules(): array
    {
        return [
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'nama_peserta' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:-13 years'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'agama' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:100'],
            'nama_wali' => ['required', 'string', 'max:100'],
            'telepon_wali' => ['required', 'string', 'max:20'],
            'asal_sekolah' => ['nullable', 'string', 'max:100'],
            'nilai_rata_rata' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'ijazah' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'tanggal_lahir.before' => 'Peserta harus berusia minimal 13 tahun.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'ijazah.max' => 'Ukuran file ijazah maksimal 5MB.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
        ];
    }
}