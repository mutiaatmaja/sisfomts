<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_sholats', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('peserta_didik_id')->constrained('peserta_didiks')->cascadeOnDelete();
            $table->foreignId('sholat_setting_id')->constrained('sholat_settings')->cascadeOnDelete();
            $table->string('nama_sholat', 20);
            $table->date('tanggal');
            $table->time('jam_absen');
            $table->enum('status', ['hadir', 'alpha']);
            $table->timestamps();

            $table->unique(['peserta_didik_id', 'sholat_setting_id', 'tanggal'], 'abs_sholat_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_sholats');
    }
};
