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
        Schema::create('pinjams', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->string('gambar', 255)->nullable();
            $table->string('serialnumber');
            $table->unsignedBigInteger('pinjamsdevice_id');
            $table->string('ram');
            $table->string('android');
            $table->string('pelanggan');
            $table->string('alamat');
            $table->string('sales');
            $table->integer('no_telp');
            $table->string('pengirim');
            $table->string('kelengkapankirim');
            $table->date('tanggalkembali')->nullable();
            $table->string('penerima')->nullable();
            $table->string('kelengkapankembali')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pinjamsdevice_id')->references('id')->on('pinjamsdevice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};
