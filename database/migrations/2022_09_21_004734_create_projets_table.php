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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('nom_Projet');
            $table->string('objet_Projet');
            $table->integer('duree_Execution');
            $table->dateTime('debut_Execution');
            $table->dateTime('fin_Execution');
            $table->string('zone_Execution');
            $table->string('Contexte');
            $table->string('Innovation');
            $table->longText('Resume');
            $table->string('Description_General');
            $table->string('description_Objectif');
            $table->double('subvention_Sollicitee');
            $table->double('total_Budget');
            $table->double('apport_Personnel');
            $table->String('description_Activite');
            $table->String('risque_Identifier');
            $table->String('description_Resultat');
            $table->unsignedBigInteger('offres_id');
            $table->foreign('offres_id')->references('id')->on('offres');
            $table->unsignedBigInteger('responsables_id');
            $table->foreign('responsables_id')->references('id')->on('responsables')
            ->constrained()->onDelete('CASCADE');
            $table->boolean('projet_Etudier')->nullable()->default(false);
            $table->dateTime('date_Etude')->nullable();
            $table->boolean('projet_Evaluer')->nullable()->default(false);
            $table->dateTime('date_Evaluation')->nullable();
            $table->enum('statut__projets', ['En Attente', 'En Cours', 'Terminé'])->nullable()->default("en attente");

           
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
        Schema::dropIfExists('projets');
    }
};
