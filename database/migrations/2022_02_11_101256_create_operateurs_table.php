<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operateurs', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("type_id");
            $table->integer("competence_id");
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign("type_id")->references('id')->on('type_users');
            $table->foreign("competence_id")->references('id')->on('type_problemes');            
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
        Schema::dropIfExists('operateurs');
    }
}
