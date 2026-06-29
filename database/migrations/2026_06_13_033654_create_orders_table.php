<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('total_price', 15, 2);
            
            // --- TAMBAHKAN 3 KOLOM INI ---
            $table->string('durasi_paket');
            $table->date('tanggal_mulai');
            $table->text('alamat_pengiriman');
            // -----------------------------

            $table->text('items'); // JSON detail menu tetap ada
            $table->string('status')->default('pending');
            $table->timestamps();

             $table->string('bukti_transfer')->nullable()->after('status');
            $table->string('bank_tujuan')->nullable()->after('bukti_transfer');
            $table->text('catatan_transfer')->nullable()->after('bank_tujuan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};