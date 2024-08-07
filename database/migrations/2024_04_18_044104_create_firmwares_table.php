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
            $table->string('tipe');
            $table->string('versi');
            $table->string('android');
            $table->string('flash')->nullable();
            $table->string('ota')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
