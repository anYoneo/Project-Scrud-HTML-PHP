<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePendaftaranRequest;
use App\Models\AuditLog;
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
            $query->where('jurusan_id', $request->jurusan_id);
        }

        $pendaftaran = $query->latest()->paginate(15)->withQueryString();
        $jurusanList = Jurusan::where('is_active', true)->get();

        return view('admin.pendaftaran.index', compact('pendaftaran', 'jurusanList'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['jurusan', 'verifier']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => ['required', 'in:verified,accepted,rejected'],
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        $oldValues = $pendaftaran->only(['status', 'catatan_admin', 'verified_by', 'verified_at']);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        AuditLog::record(
            action: 'update_status',
            entityType: 'pendaftaran',
            entityId: $pendaftaran->id,
            oldValues: $oldValues,
            newValues: $pendaftaran->only(['status', 'catatan_admin', 'verified_by', 'verified_at'])
        );

        return redirect()->route('admin.pendaftaran.show', $pendaftaran)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        AuditLog::record(
            action: 'delete',
            entityType: 'pendaftaran',
            entityId: $pendaftaran->id,
            oldValues: $pendaftaran->toArray()
        );

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}