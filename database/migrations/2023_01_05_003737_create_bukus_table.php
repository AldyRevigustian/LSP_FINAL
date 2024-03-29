<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 125);
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('penerbit_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('pengarang', 125);
            $table->smallInteger('tahun_terbit');
            $table->string('isbn', 50)->nullable();
            $table->smallInteger('j_buku_baik');
            $table->smallInteger('j_buku_rusak');
            $table->text('foto')->nullable();
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
        Schema::dropIfExists('bukus');
    }
}
