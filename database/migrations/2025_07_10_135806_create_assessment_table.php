<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_inspeksi')->nullable();
            $table->string('dept')->nullable();
            $table->string('nama_inspektur')->nullable();
            $table->string('nik_penyadap')->nullable();
            $table->string('nama_penyadap')->nullable();
            $table->string('status')->nullable();
            $table->string('kemandoran')->nullable();
            $table->string('blok')->nullable();
            $table->string('task')->nullable();
            $table->string('tahun_tanam')->nullable();
            $table->string('clone')->nullable();
            $table->string('panel_sadap')->nullable();
            $table->string('jenis_kulit_pohon')->nullable();
            $table->double('1_1')->nullable();
            $table->double('1_2')->nullable();
            $table->double('1_3')->nullable();
            $table->double('2_1')->nullable();
            $table->double('2_2')->nullable();
            $table->double('2_3')->nullable();
            $table->double('3_1')->nullable();
            $table->double('3_2')->nullable();
            $table->double('3_3')->nullable();
            $table->double('3_4')->nullable();
            $table->double('3_5')->nullable();
            $table->double('3_6')->nullable();
            $table->double('3_7')->nullable();
            $table->double('4_1')->nullable();
            $table->double('4_2')->nullable();
            $table->double('5_1')->nullable();
            $table->double('5_2')->nullable();
            $table->double('6_1')->nullable();
            $table->double('6_2')->nullable();
            $table->double('6_3')->nullable();
            $table->double('7_1')->nullable();
            $table->double('7_2')->nullable();
            $table->double('7_3')->nullable();
            $table->double('8')->nullable();
            $table->double('9')->nullable();
            $table->double('10')->nullable();
            $table->double('nilai')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment');
    }
};
