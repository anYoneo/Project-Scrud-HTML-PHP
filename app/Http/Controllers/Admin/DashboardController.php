<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunAjaran = date('Y') . '/' . (date('Y') + 1);

        $stats = [
            'total_pendaftar' => Pendaftaran::byTahunAjaran($tahunAjaran)->count(),
            'pending' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('pending')->count(),
            'verified' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('verified')->count(),
            'accepted' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('accepted')->count(),
            'rejected' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('rejected')->count(),
        ];

        $jurusanStats = Jurusan::withCount(['pendaftaran' => function ($query) use ($tahunAjaran) {
            $query->where('tahun_ajaran', $tahunAjaran);
        }])->where('is_active', true)->get();

        $recentRegistrations = Pendaftaran::with('jurusan')
            ->byTahunAjaran($tahunAjaran)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'jurusanStats', 'recentRegistrations', 'tahunAjaran'));
    }
}