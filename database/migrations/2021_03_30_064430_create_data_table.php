<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->integer('penjualan')->default(0);
            $table->integer('pembelian')->default(0);
            $table->integer('pengeluaran')->default(0);
            $table->integer('pendapatan')->default(0);
            $table->integer('laba')->default(0);
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
        Schema::dropIfExists('data');
    }
}
