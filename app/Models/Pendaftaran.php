<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'nomor_pendaftaran', 'tanggal_daftar', 'tahun_ajaran',
        'jurusan', 'nama_peserta', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'alamat', 'kecamatan_id',
        'telepon', 'asal_sekolah', 'foto', 'status',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_lahir'  => 'date',
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan', 'nama_jurusan');
    }

    public static function generateNomorPendaftaran(): string
    {
        return self::generateNomor();
    }

    /**
     * Generate unique registration number: P{YEAR}{5-digit-sequence}
     */
    public static function generateNomor(): string
    {
        $year   = Carbon::now()->year;
        $prefix = 'P' . $year;
        $last   = self::where('nomor_pendaftaran', 'like', $prefix . '%')
                      ->orderBy('nomor_pendaftaran', 'desc')
                      ->first();

        $seq = $last ? ((int) substr($last->nomor_pendaftaran, 5)) + 1 : 1;

        return $prefix . str_pad($seq, 5, '0', STR_PAD_LEFT);
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }

    public function scopeByTahunAjaran($query, $tahunAjaran)
    {
        return $query->where('tahun_ajaran', $tahunAjaran);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
