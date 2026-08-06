<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Kecamatan;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;

class PublicRegistrationController extends Controller
{
    public function create()
    {
        // Pendaftaran uses 'jurusan' varchar column. We supply a list of available programs.
        $jurusanList = [
            (object)['id' => 'Teknik Komputer dan Jaringan', 'nama_jurusan' => 'Teknik Komputer dan Jaringan (TKJ)', 'kuota' => 100, 'terisi' => 0],
            (object)['id' => 'Teknik Otomotif', 'nama_jurusan' => 'Teknik Otomotif', 'kuota' => 80, 'terisi' => 0],
            (object)['id' => 'Teknik Las', 'nama_jurusan' => 'Teknik Las', 'kuota' => 50, 'terisi' => 0],
            (object)['id' => 'Akuntansi', 'nama_jurusan' => 'Akuntansi', 'kuota' => 120, 'terisi' => 0],
            (object)['id' => 'Administrasi Perkantoran', 'nama_jurusan' => 'Administrasi Perkantoran', 'kuota' => 120, 'terisi' => 0],
        ];

        // Dynamically compute filled count from database to prevent hardcoding quotas
        foreach ($jurusanList as $j) {
            $j->terisi = Pendaftaran::where('jurusan', $j->id)->where('status', 'diterima')->count();
        }

        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();

        return view('public.registration', compact('jurusanList', 'kecamatans'));
    }

    public function store(StoreRegistrationRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        $validated['nomor_pendaftaran'] = Pendaftaran::generateNomor();
        $validated['tanggal_daftar'] = \Illuminate\Support\Carbon::today();
        $validated['tahun_ajaran'] = date('Y') . '/' . (date('Y') + 1);
        $validated['status'] = 'pending';
        // Map form jurusan_id to the jurusan column
        $validated['jurusan'] = $validated['jurusan_id'];

        if ($validated['jenis_kelamin'] === 'L') {
            $validated['jenis_kelamin'] = 'Laki-laki';
        } elseif ($validated['jenis_kelamin'] === 'P') {
            $validated['jenis_kelamin'] = 'Perempuan';
        }

        $pendaftaran = Pendaftaran::create($validated);

        return redirect()->route('registration.success', $pendaftaran->nomor_pendaftaran);
    }

    public function success(string $nomorPendaftaran)
    {
        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $nomorPendaftaran)
            ->firstOrFail();

        return view('public.registration-success', compact('pendaftaran'));
    }

    public function checkStatus()
    {
        return view('public.check-status');
    }

    public function showStatus(string $nomorPendaftaran)
    {
        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $nomorPendaftaran)
            ->firstOrFail();

        return view('public.status-result', compact('pendaftaran'));
    }
}
