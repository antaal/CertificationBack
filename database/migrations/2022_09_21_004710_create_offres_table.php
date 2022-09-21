<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('image');
            $table->string('description');
            $table->dateTime('date_Lancement');
            $table->dateTime('fin_Depot');
             // $table->unsignedBigInteger('secteurs_id')->nullable();
            // $table->foreign('secteurs_id')->references('id')->on('secteurs');
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
        Schema::dropIfExists('offres');
    }
};
