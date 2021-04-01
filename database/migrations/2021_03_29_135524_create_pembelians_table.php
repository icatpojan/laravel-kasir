<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kulakan_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('barcode');
            $table->string('name');
            $table->integer('jumlah_product')->default(0);
            $table->integer('harga')->default(0);
            $table->integer('beli')->default(0);
            $table->integer('jumlah_harga')->default(0);
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
