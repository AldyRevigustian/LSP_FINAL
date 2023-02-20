<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pengirim_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul',50);
            $table->text('isi');
            $table->enum('status', ['terkirim', 'terbaca'])->default('terkirim');
            $table->date('tanggal_kirim');
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
        Schema::dropIfExists('pesans');
    }
}
