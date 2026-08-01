<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesertaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun_ajaran'  => ['required', 'string', 'regex:/^\d{4}\/\d{4}$/'],
            'jurusan'       => ['required', 'string', 'max:100'],
            'nama_peserta'  => ['required', 'string', 'max:100'],
            'tempat_lahir'  => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'agama'         => ['required', 'string', 'max:20'],
            'alamat'        => ['required', 'string'],
            'kecamatan_id'  => ['required', 'exists:kecamatans,id'],
            'telepon'       => ['nullable', 'string', 'max:20'],
            'asal_sekolah'  => ['nullable', 'string', 'max:150'],
            'foto'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'tanggal_lahir.before'  => 'Tanggal lahir harus sebelum hari ini.',
            'kecamatan_id.exists'   => 'Kecamatan tidak valid.',
            'foto.mimes'            => 'Foto harus berformat JPG atau PNG.',
            'foto.max'              => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
