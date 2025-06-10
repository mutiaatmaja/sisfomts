<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suaramadrasahs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nama_responden');
            $table->string('hp_responden');
            $table->enum('tipe_aduan', ['gratifikasi', 'pengaduan_masyarakat', 'whistleblowing', 'kritik_saran']);
            $table->text('teks_suara')->nullable();

            // Data terlapor
            $table->text('apa');
            $table->string('siapa');
            $table->date('kapan');
            $table->string('dimana');
            $table->text('mengapa');
            $table->text('bagaimana');

            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suaramadrasahs');
    }
};
