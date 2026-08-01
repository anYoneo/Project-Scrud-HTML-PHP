<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran', 20)->unique();
            $table->date('tanggal_daftar');
            $table->string('tahun_ajaran', 9);
            $table->string('jurusan', 100);
            $table->string('nama_peserta', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 20);
            $table->text('alamat');
            $table->foreignId('kecamatan_id')->constrained('kecamatans');
            $table->string('telepon', 20)->nullable();
            $table->string('asal_sekolah', 150)->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
