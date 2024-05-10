<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori_id');
            $table->integer('user_id');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->string('slug_produk');
            $table->text('deskripsi_produk');
            $table->string('foto')->nullable();//banner produknya
            $table->double('qty', 12, 2)->default(0);
            $table->string('satuan');
            $table->double('harga', 12, 2)->default(0);
            $table->string('status');
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
        Schema::dropIfExists('produk');
    }
}