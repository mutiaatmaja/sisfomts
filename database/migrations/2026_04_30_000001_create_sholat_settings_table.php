<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sholat_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sholat', 20)->unique();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('sholat_settings')->insert([
            [
                'nama_sholat' => 'Subuh',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '05:30:00',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sholat' => 'Dzuhur',
                'jam_mulai' => '11:30:00',
                'jam_selesai' => '13:00:00',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sholat' => 'Ashar',
                'jam_mulai' => '14:30:00',
                'jam_selesai' => '16:00:00',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sholat' => 'Maghrib',
                'jam_mulai' => '17:30:00',
                'jam_selesai' => '18:30:00',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_sholat' => 'Isya',
                'jam_mulai' => '18:45:00',
                'jam_selesai' => '20:00:00',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sholat_settings');
    }
};
