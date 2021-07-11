<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('pelanggan_id');
            $table->string('teknisi_id')->nullable();
            $table->string('foto_pekerjaan')->nullable();
            $table->string('judul_foto')->nullable();
            $table->string('deskripsi_foto')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('job_photos');
    }
}
