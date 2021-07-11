<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('pelanggan_id');
            $table->string('kegiatan');
            $table->time('jam');
            $table->date('tanggal');
            // $table->time('mulai');
            // $table->time('selesai');
            // $table->integer('durasi')->nullable();
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
        Schema::dropIfExists('job_activities');
    }
}
