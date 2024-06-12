<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('kamar_id')->unsigned()->index();
            $table->string('kode')->unique();
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tanggal_pesan');
            $table->integer('total_harga');
            $table->enum('durasi',[1,6,12]);
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->enum('status',['Menunggu','Sukses','Dibatalkan'])->default('Menunggu');
            $table->dateTime('expired_at');
            $table->timestamps();

            $table->foreign('kamar_id')
                ->references('id')->on('kamars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('bookings');
    }
}
