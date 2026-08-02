<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HealthController extends Controller
{
    public function __invoke()
    {
        $checks = [
            'status' => 'healthy',
            'timestamp' => now()->toIso8601String(),
            'version' => config('app.version', '2.0.0'),
            'checks' => [
                'database' => $this->checkDatabase(),
                'storage' => $this->checkStorage(),
            ],
        ];

        $allHealthy = collect($checks['checks'])->every(fn ($c) => $c['status'] === 'ok');
        $checks['status'] = $allHealthy ? 'healthy' : 'degraded';

        return response()->json($checks, $allHealthy ? 200 : 503);
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'ok', 'latency_ms' => round((microtime(true) - LARAVEL_START) * 1000)];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Database connection failed'];
        }
    }

    private function checkStorage(): array
    {
        try {
            $writable = is_writable(storage_path());
            return ['status' => $writable ? 'ok' : 'error'];
        } catch (\Exception $e) {
            return ['status' => 'error'];
        }
    }
}