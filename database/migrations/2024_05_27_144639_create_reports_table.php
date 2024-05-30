<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Usuario que realiza el reporte
            $table->unsignedBigInteger('reportable_id'); // ID del objeto reportado
            $table->string('reportable_type'); // Tipo del objeto reportado (Post, Comment, User, Group)
            $table->string('reason'); // Motivo del reporte
            $table->text('description')->nullable(); // Descripción opcional del reporte
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
