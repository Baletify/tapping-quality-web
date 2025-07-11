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
        Schema::create('assessments', function (Blueprint $table) {
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
            $table->double('item1_1')->nullable();
            $table->double('item1_2')->nullable();
            $table->double('item1_3')->nullable();
            $table->double('item2_1')->nullable();
            $table->double('item2_2')->nullable();
            $table->double('item2_3')->nullable();
            $table->double('item3_1')->nullable();
            $table->double('item3_2')->nullable();
            $table->double('item3_3')->nullable();
            $table->double('item3_4')->nullable();
            $table->double('item3_5')->nullable();
            $table->double('item3_6')->nullable();
            $table->double('item3_7')->nullable();
            $table->double('item4_1')->nullable();
            $table->double('item4_2')->nullable();
            $table->double('item5_1')->nullable();
            $table->double('item5_2')->nullable();
            $table->double('item6_1')->nullable();
            $table->double('item6_2')->nullable();
            $table->double('item6_3')->nullable();
            $table->double('item7_1')->nullable();
            $table->double('item7_2')->nullable();
            $table->double('item7_3')->nullable();
            $table->double('item8')->nullable();
            $table->double('item9')->nullable();
            $table->double('item10')->nullable();
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
