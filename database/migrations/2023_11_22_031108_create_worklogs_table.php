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
        Schema::create('worklogs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_employees')->unsigned();
            $table->foreign('id_employees')->references('id')->on('employees');
            $table->integer('id_projects')->unsigned();
            $table->foreign('id_projects')->references('id')->on('projects');
            $table->date('tanggal');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worklogs');
    }
};
