<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;

class PublicRegistrationController extends Controller
{
    public function create()
    {
        $jurusanList = Jurusan::where('is_active', true)
            ->withCount(['pendaftaran' => function ($q) {
                $q->where('status', 'accepted');
            }])
            ->get()
            ->map(function ($j) {
                $j->sisa_kuota = max(0, $j->kuota - $j->pendaftaran_count);
                return $j;
            });

        return view('public.registration', compact('jurusanList'));
    }

    public function store(StoreRegistrationRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto_path'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        if ($request->hasFile('ijazah')) {
            $validated['ijazah_path'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        }

        $validated['nomor_pendaftaran'] = Pendaftaran::generateNomorPendaftaran();
        $validated['tahun_ajaran'] = date('Y') . '/' . (date('Y') + 1);
        $validated['status'] = 'pending';

        $pendaftaran = Pendaftaran::create($validated);

        return redirect()->route('registration.success', $pendaftaran->nomor_pendaftaran);
    }

    public function success(string $nomorPendaftaran)
    {
        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $nomorPendaftaran)
            ->with('jurusan')
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
            ->with('jurusan')
            ->firstOrFail();

        return view('public.status-result', compact('pendaftaran'));
    }
}