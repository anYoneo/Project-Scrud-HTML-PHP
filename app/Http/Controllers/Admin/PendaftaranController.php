<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePendaftaranRequest;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with('jurusan');

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_peserta', 'like', "%{$search}%")
                  ->orWhere('nomor_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jurusan_id')) {
            $selectedJurusan = Jurusan::find($request->jurusan_id);
            if ($selectedJurusan) {
                $query->where('jurusan', $selectedJurusan->nama_jurusan);
            }
        }

        $pendaftarans = $query->latest()->paginate(15)->withQueryString();
        $jurusans = Jurusan::where('is_active', true)->get();

        return view('admin.pendaftaran.index', compact('pendaftarans', 'jurusans'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['jurusan']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => ['required', 'in:pending,verified,accepted,rejected,diterima,ditolak'],
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        $status = $request->status;
        if ($status === 'accepted' || $status === 'verified') {
            $status = 'diterima';
        } elseif ($status === 'rejected') {
            $status = 'ditolak';
        }

        $oldValues = $pendaftaran->only(['status', 'catatan_admin', 'verified_by', 'verified_at']);

        $pendaftaran->update([
            'status' => $status,
            'catatan_admin' => $request->catatan_admin,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.pendaftaran.show', $pendaftaran)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
