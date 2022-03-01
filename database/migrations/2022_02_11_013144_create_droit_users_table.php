<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroitUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droit_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('type_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign("type_id")->references('id')->on('type_users'); 
            $table->integer('competence')->nullable();
            $table->foreign('competence')->references('id')->on('type_problemes');;           
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
        Schema::dropIfExists('droit_users');
    }
}
