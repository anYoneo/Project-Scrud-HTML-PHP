<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total'    => Pendaftaran::count(),
            'pending'  => Pendaftaran::where('status', 'pending')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak'  => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        $recentPendaftaran = Pendaftaran::with('kecamatan')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentPendaftaran'));
    }
}
