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
        Schema::create('pengajuan_danas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_pengajuan');
            $table->decimal('jumlah_dana', 15, 2);
            $table->text('keterangan');
            $table->string('status')->default('pending'); // 'pending', 'disetujui', 'ditolak'
            $table->text('catatan_pengurus')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_danas');
    }
};
