<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
        public function up()
        {
            Schema::create('counters', function (Blueprint $table) {
                $table->uuid('id')->primary(); // UUID sebagai primary key
                $table->string('type')->unique(); // Jenis akses, misalnya 'frontend' atau 'check_certificate'
                $table->unsignedBigInteger('count')->default(0); // Jumlah akses
                $table->timestamps(); // Kolom created_at dan updated_at
            });
        }

    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
