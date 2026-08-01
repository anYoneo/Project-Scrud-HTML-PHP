<?php

namespace App\Http\Controllers;

use App\Http\Requests\PesertaRequest;
use App\Models\Kecamatan;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PesertaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pendaftaran::with('kecamatan');

        if ($request->filled('search')) {
            $query->where('nama_peserta', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_pendaftaran', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        $pendaftarans = $query->latest()->paginate(15);
        $jurusans     = Pendaftaran::select('jurusan')->distinct()->pluck('jurusan');

        return view('peserta.index', compact('pendaftarans', 'jurusans'));
    }

    public function create(): View
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('peserta.create', compact('kecamatans'));
    }

    public function store(PesertaRequest $request): RedirectResponse
    {
        $data                      = $request->validated();
        $data['nomor_pendaftaran'] = Pendaftaran::generateNomor();
        $data['tanggal_daftar']    = Carbon::today();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-peserta', 'public');
        }

        Pendaftaran::create($data);

        return redirect()->route('peserta.index')
            ->with('success', 'Pendaftaran berhasil disimpan dengan nomor: ' . $data['nomor_pendaftaran']);
    }

    public function show(Pendaftaran $peserta): View
    {
        $peserta->load('kecamatan');
        return view('peserta.show', compact('peserta'));
    }

    public function edit(Pendaftaran $peserta): View
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('peserta.edit', compact('peserta', 'kecamatans'));
    }

    public function update(PesertaRequest $request, Pendaftaran $peserta): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($peserta->foto) {
                Storage::disk('public')->delete($peserta->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-peserta', 'public');
        }

        $peserta->update($data);

        return redirect()->route('peserta.show', $peserta)
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $peserta): RedirectResponse
    {
        if ($peserta->foto) {
            Storage::disk('public')->delete($peserta->foto);
        }

        $peserta->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }

    public function autocompleteKecamatan(Request $request): \Illuminate\Http\JsonResponse
    {
        $kecamatans = Kecamatan::where('nama_kecamatan', 'like', '%' . $request->q . '%')
            ->orderBy('nama_kecamatan')
            ->get(['id', 'nama_kecamatan']);

        return response()->json($kecamatans);
    }

    public function updateStatus(Request $request, Pendaftaran $peserta): RedirectResponse
    {
        $request->validate(['status' => 'required|in:pending,diterima,ditolak']);
        $peserta->update(['status' => $request->status]);

        return back()->with('success', 'Status peserta berhasil diperbarui.');
    }
}
