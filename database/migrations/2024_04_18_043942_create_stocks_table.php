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
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serialnumber');
            $table->unsignedBigInteger('stocksdevice_id');
            $table->string('noinvoice');
            $table->date('tanggalmasuk');
            $table->date('tanggalkeluar')->nullable();
            $table->string('pelanggan');
            $table->string('lokasi');
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stocksdevice_id')->references('id')->on('stocksdevice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
