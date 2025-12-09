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
         if(!Schema::hastable('pengaduan')){
             Schema::create('pengaduan', function (Blueprint $table) {
            // Primary Key
        $table->id('pengaduan_id');

        // Foreign Key ke kategori_penagaduan
        $table->unsignedBigInteger('kategori_id');

        // Foreign Key ke warga
        $table->unsignedBigInteger('warga_id');

        // kolom yang tidak berelasi
        $table->string('no_tiket')->unique();
        $table->string('judul', 100);
        $table->string('deskripsi', 100);
        $table->enum('status', ['sedang_diproses', 'sudah_selesai'])->nullable();
        $table->string('lokasi_text', 100);
        $table->string('rt', 100);
        $table->string('rw', 100);

        $table->timestamps();

        // Relasi ke keluarga_kk
        $table->foreign('kategori_id')
            ->references('kategori_id')->on('kategori_pengaduan')
            ->onDelete('cascade');

        // Relasi ke warga
        $table->foreign('warga_id')
            ->references('warga_id')->on('warga')
            ->onDelete('cascade');
    });

        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
