<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('type_probleme_id');
            $table->integer('demandeur_id');
            $table->integer('operateur_id')->nullable();
            $table->integer('responsable_id')->nullable();
            $table->foreign('type_probleme_id')->references('id')->on('type_problemes');
            $table->date('datecreation');
            $table->string("description");
            $table->foreign('demandeur_id')->references('id')->on('demandeurs');
            $table->foreign('operateur_id')->references('id')->on('operateurs'); 
            $table->foreign('responsable_id')->references('id')->on('responsables');
            $table->string('piecejointe')->nullable();          
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
        Schema::dropIfExists('tickets');
    }
}
