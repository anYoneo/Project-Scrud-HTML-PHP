<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $fillable = ['nama_jurusan', 'kuota', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'jurusan', 'nama_jurusan');
    }
}
