<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelapor');
            $table->string('alamat_pelapor');
            $table->string('no_telp_pelapor');
            $table->integer('prov_id')->nullable();
            $table->integer('kab_id')->nullable();
            $table->integer('kec_id')->nullable();
            $table->integer('kel_id')->nullable();
            $table->text('isi_laporan');
            $table->tinyInteger('instansi');
            $table->tinyInteger('asal_instansi');
            $table->string('solusi');
            $table->tinyInteger('id_jenis_aduan');
            $table->tinyInteger('user_id');
            $table->tinyInteger('role_id');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
