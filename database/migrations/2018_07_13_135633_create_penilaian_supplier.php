<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('po_number')->nullable();
            $table->integer('suppliers_id')->references('id')->on('suppliers');
            $table->date('tanggal')->nullable();
            $table->integer('products_id')->references('id')->on('products');
            $table->float('drum')->nullable();
            $table->float('kg')->nullable();
            $table->float('satuan')->nullable();
            $table->float('jumlah')->nullable();
            $table->integer('harga')->references('id')->on('sub_kriterias');
            $table->integer('mutu')->references('id')->on('sub_kriterias');
            $table->integer('layanan')->references('id')->on('sub_kriterias');
            $table->integer('pembayaran')->references('id')->on('sub_kriterias');
            $table->integer('waktu')->references('id')->on('sub_kriterias');
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
        Schema::drop('penilaian_supplier');
    }
}
