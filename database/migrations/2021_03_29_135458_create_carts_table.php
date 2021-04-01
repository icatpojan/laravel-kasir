<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penjualan_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name')->default(0);
            $table->unsignedBigInteger('barcode');
            $table->integer('jual')->default(0);
            $table->integer('beli')->default(0);
            $table->integer('jumlah_product')->default(0);
            $table->integer('jumlah_harga')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('carts');
    }
}
