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
        Schema::create('job_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('users_id')->references('id')->on('users');
            $table->string('judul');
            $table->text('deskripsi');
            $table->decimal('gaji', 10, 2);
            $table->string('kategori');
            $table->enum('type', ['Remote', 'FullTime', 'Parttime', 'Contract']);
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_users');
    }
};
