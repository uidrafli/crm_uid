<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanRoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_ro', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('user_name');
            $table->string('subject');
            $table->string('nama_acara');
            $table->string('tanggal_acara');
            $table->string('lokasi');
            $table->integer('durasi'); // jam
            $table->text('deskripsi')->nullable();
            $table->string('approval_status')->nullable();
            $table->bigInteger('approval_id')->nullable();
            $table->string('approval_name')->nullable();
            $table->bigInteger('approval_id_leader')->nullable();
            $table->string('approval_name_leader')->nullable();
            $table->string('validation')->nullable();
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
        Schema::dropIfExists('pengajuan_ro');
    }
}
