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
          if(!Schema::hastable('tindak_lanjut')){
        Schema::create('tindak_lanjut', function (Blueprint $table) {
            //primary key
            $table->id('tindak_id');

            // Foreign Key ke pengaduan
        $table->unsignedBigInteger('pengaduan_id');

         // kolom yang tidak berelasi
        $table->string('petugas', 100);
         $table->enum('aksi', ['selesai' ,'ditolak'])->nullable();
        $table->string('catatan', 100);


            $table->timestamps();

            // Relasi ke pengaduan
        $table->foreign('pengaduan_id')
            ->references('pengaduan_id')->on('pengaduan')
            ->onDelete('cascade');

        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjut');
    }
};
