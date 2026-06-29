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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->text('ingredients')->nullable(); // Menampung bahan-bahan menu
            $table->integer('harga');
            $table->string('kategori');
            $table->string('label')->nullable();
            $table->decimal('rating', 3, 2)->default(4.50); // Diubah ke (3,2) supaya bisa menyimpan hasil desimal rumus seperti 4.33
            $table->integer('rating_count')->default(1);    // Ditambahkan sebagai $ViewerLama (Default 1 karena rating awal 4.5)
            $table->integer('calories')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('carbs')->nullable();
            $table->integer('fat')->nullable();
            $table->string('gambar')->nullable();
            $table->string('video')->nullable(); // Menampung link/path video sajian makanan
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};