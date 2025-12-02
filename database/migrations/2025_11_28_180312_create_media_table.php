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
        Schema::create('media', function (Blueprint $table) {
           // 1. Primary Key: media_id
            $table->id('media_id');

            // 2. Referensi Tabel & ID (Tanpa Foreign Key)
            $table->string('ref_table', 50)->nullable();
            $table->integer('ref_id')->nullable();

            // 3. Nama File
            $table->string('file_name');

            // 4. Kolom Tambahan (Opsional tapi diminta)
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
