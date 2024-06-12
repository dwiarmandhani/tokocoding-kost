<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeri_kamars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto');
            $table->integer('tipe_kamar_id')->unsigned()->index();
            $table->timestamps();

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
        Schema::dropIfExists('galeri_kamars');
    }
}
