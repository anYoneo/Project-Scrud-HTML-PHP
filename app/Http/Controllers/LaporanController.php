<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function cetakBukti(Pendaftaran $peserta): View
    {
        $peserta->load('kecamatan');
        return view('laporan.bukti', compact('peserta'));
    }

    public function cetakDaftar(Request $request): View
    {
        $query = Pendaftaran::with('kecamatan');

        if ($request->filled('tahun_ajaran')) {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }
        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftarans = $query->orderBy('nomor_pendaftaran')->get();
        $filters      = $request->only(['tahun_ajaran', 'jurusan', 'status']);

        return view('laporan.daftar', compact('pendaftarans', 'filters'));
    }
}
