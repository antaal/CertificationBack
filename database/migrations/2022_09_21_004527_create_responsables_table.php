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
        Schema::create('responsables', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_Naissance');
            $table->string('Telephone');
            $table->boolean('Genre');
            $table->String('Numero_identite');
            $table->string('releve_Bancaire');
            $table->String('Numero_piece');
             $table->String('Recepisse');
            $table->enum('type_Representant',
             ['Association', 'Entreprise', 'Individu'])
            ;
            $table->unsignedBigInteger('quartiers_id');
            $table->foreign('quartiers_id')->references('id')->on('quartiers');
            // $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('responsables');
    }
};
