<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendidik_tendiks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nuptk')->nullable();
            $table->string('nip')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nrg')->nullable();
            $table->string('npwp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidik_tendiks');
    }
};
