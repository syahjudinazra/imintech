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
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serialnumber');
            $table->date('tanggalmasuk');
            $table->date('tanggalselesai')->nullable();
            $table->string('pemilik');
            $table->string('status');
            $table->string('pelanggan');
            $table->unsignedBigInteger('servicesdevice_id');
            $table->foreign('servicesdevice_id')->references('id')->on('servicesdevice')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pemakaian');
            $table->string('kerusakan');
            $table->string('perbaikan')->nullable();
            $table->string('nosparepart')->nullable();
            $table->string('snkanibal')->nullable();
            $table->string('teknisi')->nullable();
            $table->string('catatan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
