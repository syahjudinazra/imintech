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
        Schema::create('firmwares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('firmwaresdevice_id');
            $table->string('versi');
            $table->string('android');
            $table->string('flash');
            $table->string('ota');
            $table->string('kategori');
            $table->string('gambar', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('firmwaresdevice_id')->references('id')->on('firmwaresdevice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmwares');
    }
};
