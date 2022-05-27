<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LogArticulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logarticulos', function (Blueprint $table){
            $table->id();
            $table->integer('idArticulo');
            
            $table->string('articuloO', 50)->nullable();
            $table->integer('precioO')->nullable();
            $table->string('descripcionO', 200)->nullable();
            $table->string('categoria_idO', 15)->nullable();
            $table->string('image_pathO')->nullable();

            $table->string('articuloN', 50)->nullable();
            $table->integer('precioN')->nullable();
            $table->string('descripcionN', 200)->nullable();
            $table->string('categoria_idN', 15)->nullable();
            $table->string('image_pathN')->nullable();

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
        //
    }
}
