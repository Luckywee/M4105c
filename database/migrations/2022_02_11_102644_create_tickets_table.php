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
            $table->integer('droituser_id');
            $table->foreign('type_probleme_id')->references('id')->on('type_problemes');
            $table->date('datecreation');
            $table->string("description");
            $table->foreign('droituser_id')->references('id')->on('droit_users');
            $table->integer('operateur_id')->nullable();
            $table->foreign('operateur_id')->references('id')->on('droit_users');
            $table->integer('etat_id');
            $table->foreign('etat_id')->references('id')->on('etat_tickets');
            $table->string('piecejointe')->nullable();
            $table->string('commentaire')->nullable();
            $table->date('resolu_at')->nullable();
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
