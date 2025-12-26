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
          if(!Schema::hastable('penilaian_layanan')){
        Schema::create('penilaian_layanan', function (Blueprint $table) {
            //primary key
            $table->id('penilaian_id');

            // Foreign Key ke pengaduan
        $table->unsignedBigInteger('pengaduan_id');

         // kolom yang tidak berelasi
       $table->unsignedTinyInteger('rating');
         $table->string('komentar', 255);



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
        Schema::dropIfExists('penilaian_layanan');
    }
};
