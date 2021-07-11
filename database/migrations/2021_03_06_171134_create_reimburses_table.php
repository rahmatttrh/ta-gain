<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimburses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->integer('nominal');
            $table->string('keterangan', 250);
            $table->string('bukti_nota_kordinator', 250)->nullable();
            $table->string('bukti_nota_admin', 250)->nullable();
            $table->string('status', 15)->nullable();
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
        Schema::dropIfExists('reimburses');
    }
}
