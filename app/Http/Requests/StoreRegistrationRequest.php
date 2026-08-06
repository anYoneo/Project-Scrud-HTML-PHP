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
            'jurusan_id' => ['required', 'string', 'in:Teknik Komputer dan Jaringan,Teknik Otomotif,Teknik Las,Akuntansi,Administrasi Perkantoran'],
            'nama_peserta' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:-13 years'],
            'jenis_kelamin' => ['required', 'in:L,P,Laki-laki,Perempuan'],
            'agama' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string', 'max:500'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'asal_sekolah' => ['nullable', 'string', 'max:100'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'kecamatan_id' => ['required', 'exists:kecamatans,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'tanggal_lahir.before' => 'Peserta harus berusia minimal 13 tahun.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'jurusan_id.in' => 'Jurusan yang dipilih tidak valid.',
        ];
    }
}
