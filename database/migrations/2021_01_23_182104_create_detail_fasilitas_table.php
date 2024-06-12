<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_fasilitas', function (Blueprint $table) {
            $table->integer('fasilitas_id')->unsigned()->index();
            $table->integer('tipe_kamar_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('fasilitas_id')
                ->references('id')->on('fasilitas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipe_kamar_id')
                ->references('id')->on('tipe_kamars')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_fasilitas');
    }
}
