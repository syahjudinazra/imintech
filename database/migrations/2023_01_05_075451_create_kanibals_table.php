<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKanibalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kanibals', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('serialnumber');
            $table->string('pelanggan')->nullable();
            $table->string('model');
            $table->string('ram')->nullable();
            $table->string('android')->nullable();
            $table->string('kerusakan');
            $table->boolean('kerusakanbawaan')->default(0);
            $table->string('teknisi');
            $table->text('perbaikan')->nullable();
            $table->string('snkanibal')->nullable();
            $table->string('nosparepart')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kanibals');
    }
}
