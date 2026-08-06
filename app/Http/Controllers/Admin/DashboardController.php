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
            'total' => Pendaftaran::byTahunAjaran($tahunAjaran)->count(),
            'pending' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('pending')->count(),
            'verified' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('verified')->count(),
            'accepted' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('accepted')->count(),
            'rejected' => Pendaftaran::byTahunAjaran($tahunAjaran)->byStatus('rejected')->count(),
        ];

        $jurusans = Jurusan::where('is_active', true)->get()->map(function ($j) use ($tahunAjaran) {
            $j->terisi = Pendaftaran::where('jurusan', $j->nama_jurusan)
                ->byTahunAjaran($tahunAjaran)
                ->where('status', 'accepted')
                ->count();
            return $j;
        });

        $recentRegistrations = Pendaftaran::with('jurusan')
            ->byTahunAjaran($tahunAjaran)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'jurusans', 'recentRegistrations', 'tahunAjaran'));
    }
}
