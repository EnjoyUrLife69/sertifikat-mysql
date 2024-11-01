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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_penerima');
            $table->uuid('id_training');
            $table->string('email')->unique()->nullable();
            $table->boolean('status')->default(0);
            $table->string('nomor_sertifikat')->unique()->nullable(); // Menambahkan kolom nomor_sertifikat

            $table->timestamps();

            $table->foreign('id_training')->references('id')->on('trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
