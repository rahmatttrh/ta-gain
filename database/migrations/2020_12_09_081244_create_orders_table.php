<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('joborder_id')->nullable();
            $table->foreignId('pelanggan_id')->nullable();
            $table->foreignId('kordinator_id')->nullable();
            $table->string('bast')->nullable();
            $table->string('status')->nullable();
            $table->string('site')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('alamat')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('nama_projek')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('system_antena')->nullable();
            $table->string('jenis_pekerjaan')->nullable();
            $table->integer('harga_paket')->nullable();
            $table->integer('total_reimburse')->nullable();
            $table->integer('grand_total')->nullable();
            $table->string('modem')->nullable();
            $table->string('alasan_penolakan')->nullable();
            $table->string('keterangan_status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
